<?php

namespace App\Http\Controllers\Backend;

use App\Models\File;
use App\Models\TrackFile;
use App\Models\FileUpload;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Jobs\ProcessUploadedFile;
use Illuminate\Support\Facades\Bus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {


        $request->validate([
            'files.*' => 'required|file', // Validate files
            'expire_date' => 'required', // Expiration days (1 to 7 days)
            'password' => 'nullable|string',
        ]);

        $totalUploadSize = array_sum(array_map(
            fn($file) => $file->getSize(),
            $request->file('files')
        ));

        $user = auth()->user();

        // $maxFileSize = $user && $user->hasPremiumPlan() ? 20480000000 : 10737418240; // 20GB or 10GB
        // $maxTotalSize = $user && $user->hasPremiumPlan() ? 214748364800 : 107374182400; // 200GB or 100GB

        $maxFileSize =  10737418240; // 20GB or 10GB
        $maxTotalSize =  107374182400; // 200GB or 100GB


        foreach ($request->file('files') as $file) {
            if ($file->getSize() > $maxFileSize) {
                return response()->json([
                    'error' => 'One or more files exceed the maximum allowed size for your plan. Please log in or upgrade your plan.'
                ], 403);
            }
        }

        if ($totalUploadSize > $maxTotalSize) {
            return response()->json([
                'error' => 'Total upload size exceeds the maximum allowed limit for your plan. Please log in or upgrade your plan.'
            ], 403);
        }

        $uploadedFileIds = [];



        $trackFile =     TrackFile::create([
            'name' => Str::random(6)
        ]);

        $batch = Bus::batch([])->dispatch(); // Start a batch of jobs


        // foreach ($request->file('files') as $file) {
        //     // Create a database record for the file
        //     $fileUpload = FileUpload::create([
        //         'expires_at' => now()->addDays($request->expires_at),
        //         'password' => $request->password ? bcrypt($request->password) : null,
        //         'user_id' => $user ? $user->id : null,
        //         'track_file_id' => $trackFile->id
        //     ]);
        //     $uploadedFileIds[] = $fileUpload->id;
        //     $batch->add(new ProcessUploadedFile($fileUpload, $file));
        // }

        foreach ($request->file('files') as $file) {
            // Create a database record for the file
            $fileUpload = FileUpload::create([
                'expires_at' => now()->addDays($request->expires_at),
                'password' => $request->password ? bcrypt($request->password) : null,
                'user_id' => $user ? $user->id : null,
                'track_file_id' => $trackFile->id
            ]);
            $uploadedFileIds[] = $fileUpload->id;

            // Store the file temporarily
            $filePath = $file->storeAs('uploads', $file->getClientOriginalName());

            // Dispatch the job with file path
            $batch->add(new ProcessUploadedFile($fileUpload, storage_path("app/{$filePath}")));
        }



        return response()->json([
            'success' => true,
            'trackFileName' => $trackFile->name,
            'batch' => $batch->id
        ]);
        // foreach ($request->file('files') as $file) {
        //     $fileUpload = FileUpload::create([
        //         'expires_at' => now()->addDays($request->expires_at),
        //         'password' => $request->password ? bcrypt($request->password) : null,
        //         'user_id' => $user ? $user->id : null,
        //     ]);
        //     $media = $fileUpload->addMedia($file)->toMediaCollection('uploads');
        //     $media->getTemporaryUrl(
        //         now()->addDays($request->expires_at)
        //     );
        //     $uploadedFileIds[] = $fileUpload->id;
        // }

        return response()->json([
            'success' => true,
            'trackFile' => $trackFile,
        ]);

        return response()->json(['success' => true, 'uploads' => $uploadedFiles]);
    }

    public function getUploadProgress($batchId)
    {
        $batch = Bus::findBatch($batchId);

        if (!$batch) {
            return response()->json(['error' => 'Batch not found'], 404);
        }

        return response()->json([
            'total_jobs' => $batch->totalJobs,
            'pending_jobs' => $batch->pendingJobs,
            'failed_jobs' => $batch->failedJobs,
            'processed_jobs' => $batch->processedJobs(),
            'progress' => $batch->progress(), // Percentage (0–100)
        ]);
        // Return progress as a percentage
        return response()->json([
            'progress' => $progress, // Return the progress value (e.g., 70 for 70%)
            'trackFileName' => 'example-filename.zip', // Example track file name for redirection
        ]);
    }

    public function getDownload(Request $request, $fileName)
    {


        $fileUpload = FileUpload::query()->where('name', $fileName)->first();
        $trackFile = TrackFile::query()->where('file_upload_id', $fileUpload->id)->get();


        return view('getfile', compact('trackFile','fileUpload'));
        //   return response()->download($filePath);
    }

    public function getDownloadLink(Request $request, $fileName)
    {


      //  $fileUpload = FileUpload::query()->where('name', $fileName)->first();
 //       $link = $fileName;
        $link = url('get/download/' . $fileName);
        $qrCode = QrCode::size(200)->generate($link);
    
    
        return view('get-download-link', compact('link', 'qrCode'));
    }


  


    public function getDownloadNew($file)
    {
        // Validate the file path or identifier if necessary
        $filePath = storage_path('app/uploads/' . $file); // Adjust based on where your files are stored

        if (file_exists($filePath)) {
            return response()->download($filePath); // Serve the file for download
        } else {
            return redirect()->route('home')->with('error', 'File not found');
        }
    }

    public function download(Request $request)
    {
        if ($file->expires_at->isPast()) {
            return response('This link has expired.', 403);
        }

        if ($file->password && !Hash::check($request->password, $file->password)) {
            return response('Invalid password.', 403);
        }

        $media = $file->getFirstMedia('uploads');
        return response()->download($media->getPath(), $file->name);
    }


    public function showUpgradePage()
    {
        return view('upgrade');
    }
}
