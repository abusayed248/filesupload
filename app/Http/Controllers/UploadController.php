<?php

namespace App\Http\Controllers;

// use ZipArchive;
use ZipArchive;
use App\Models\Folder;
use Stripe\StripeClient;

use ZipStream\ZipStream;
use App\Models\TrackFile;
use App\Models\UserPlans;
use App\Models\FileUpload;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use ZipStream\Option\Archive;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Pion\Laravel\ChunkUpload\Exceptions\UploadFailedException;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;

class UploadController extends Controller
{
    public function index()
    {
        return view('upload');
    }


    public function showPaymentPage()
    {
        $userPlan = UserPlans::query()->first();
        return view("payment", compact("userPlan"));
    }

    public function forceDownload(Request $request)
    {
        $fileUrl = $request->query('filepath');
        $baseUrlToSkip = 'https://s3.eu-central-1.amazonaws.com/fileupload.io/';
        $filePath = str_replace($baseUrlToSkip, '', $fileUrl);
        $filePath = urldecode($filePath);

        // Validate file existence
        if (!Storage::disk('s3')->exists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        // Generate a temporary S3 URL (useful for private files)
        $temporaryUrl = Storage::disk('s3')->temporaryUrl($filePath, now()->addMinutes(10));
        $fileName = basename($filePath);

        // Use StreamedResponse to stream the file directly from the S3 URL
        return new StreamedResponse(function () use ($temporaryUrl) {
            $stream = fopen($temporaryUrl, 'r');
            while (!feof($stream)) {
                echo fread($stream, 8192); // Stream in chunks to reduce memory usage
                flush(); // Ensure the data is sent to the client
            }
            fclose($stream);
        }, 200, [
            'Content-Type' => 'application/octet-stream', // Generic binary MIME type
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }

    public function forceDownload12(Request $request)
    {
        $fileUrl = $request->query('filepath');


        $fileName = basename($fileUrl);
        $baseUrlToSkip = 'https://s3.eu-central-1.amazonaws.com/fileupload.io/';
        $filePath = str_replace($baseUrlToSkip, '', $fileUrl);
        $filePath = urldecode($filePath);

        // Validate file existence
        if (!Storage::disk('s3')->exists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        // Generate a temporary S3 URL (useful for private files)
        $temporaryUrl = Storage::disk('s3')->temporaryUrl($filePath, now()->addMinutes(10));

        // Get the file's MIME type for proper handling
        $mimeType = Storage::disk('s3')->mimeType($filePath);
        $fileName = basename($filePath);

        // Return a streamed response to force download
        return new StreamedResponse(function () use ($temporaryUrl) {
            echo file_get_contents($temporaryUrl);
        }, 200, [
            'Content-Type' => $mimeType,  // File's original MIME type
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }

    public function downloadZipWithOutAws(Request $request)
    {
        $fileUrls = $request->input('files'); // Array of file URLs
        $zipFileName = 'files-' . time() . '.zip';

        // Temporary file path
        $zipFilePath = storage_path('app/public/' . $zipFileName);

        // Get the base URL for storage (this will work on both localhost and live domains)
        $baseUrl = asset('storage/'); // This will automatically return the base URL for your storage (e.g., http://yourdomain.com/storage/)

        // Create the ZipArchive object
        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE) === true) {
            foreach ($fileUrls as $fileUrl) {
                // Convert URL to file path by removing the base URL part
                $filePath = str_replace($baseUrl, 'public/', $fileUrl);

                // Get the file content from storage
                if (Storage::exists($filePath)) {
                    $fileContent = Storage::get($filePath); // Get file content
                    $fileName = basename($filePath); // Extract the file name
                    $zip->addFromString($fileName, $fileContent); // Add file to ZIP
                }
            }
            $zip->close();
        }

        // Return ZIP file for download
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

    public function downloadZip(Request $request)
    {
        $fileUrls = json_decode($request->query('files'), true);

        $zipFileName = 'download.zip';

        return response()->streamDownload(function () use ($fileUrls) {
            $zip = new \ZipArchive;
            $tempFile = tempnam(sys_get_temp_dir(), 'zip');

            if ($zip->open($tempFile, \ZipArchive::CREATE) === true) {
                foreach ($fileUrls as $file) {
                    $fileContents = file_get_contents($file);
                    $fileName = basename($file); // Extract the file name
                    $zip->addFromString($fileName, $fileContents);
                }
                $zip->close();
            }

            // Stream the file contents
            readfile($tempFile);
            unlink($tempFile); // Clean up the temporary file after use
        }, $zipFileName, [
            'Content-Type' => 'application/zip',
            'Content-Disposition' => "attachment; filename=\"{$zipFileName}\"",
        ]);
    }

    public function downloadZip63(Request $request)
    {


        $zipFileName = 'files-' . time() . '.zip';
        $fileUrls = json_decode($request->query('files'), true);

        // Logic to create a ZIP file from the given files
        $zipFileName = 'download.zip';
        $zip = new \ZipArchive;

        $tempFile = tempnam(sys_get_temp_dir(), $zipFileName);

        if ($zip->open($tempFile, \ZipArchive::CREATE) === true) {
            foreach ($fileUrls as $file) {
                $fileContents = file_get_contents($file);
                $fileName = basename($file); // Extract the file name
                $zip->addFromString($fileName, $fileContents);
            }
            $zip->close();

            return response()->download($tempFile, $zipFileName)->deleteFileAfterSend(true);
        }

        return response()->json(['error' => 'Unable to create ZIP file'], 500);
    }


    public function downloadZip3(Request $request)
    {

        $fileUrls = $request->input('files');
        $zipFileName = 'files-' . time() . '.zip';

        // Streamed response for downloading ZIP
        return new StreamedResponse(function () use ($fileUrls, $zipFileName) {
            // Set options for ZipStream
            $options = new Archive();
            $options->setSendHttpHeaders(true);
            $options->setContentDisposition('attachment; filename="' . $zipFileName . '"');

            // Initialize ZipStream
            $zip = new ZipStream(null, $options);

            foreach ($fileUrls as $fileUrl) {
                $fileName = basename($fileUrl);
                $baseUrlToSkip = 'https://s3.eu-central-1.amazonaws.com/fileupload.io/';
                $filePath = str_replace($baseUrlToSkip, '', $fileUrl);
                $filePath = urldecode($filePath);

                if (Storage::disk('s3')->exists($filePath)) {
                    // Stream the file content directly into the ZIP archive
                    $stream = Storage::disk('s3')->readStream($filePath);

                    $zip->addFileFromStream($fileName, $stream);
                    fclose($stream);
                } else {
                    Log::warning('File does not exist on S3: ' . $filePath);
                }
            }

            // Finalize the ZIP stream
            $zip->finish();

            // Flush the content
            ob_flush();
            flush();
        }, 200, [
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="' . $zipFileName . '"',
        ]);
    }


    public function downloadZip45(Request $request)
    {
        $fileUrls = $request->input('files');
        $zipFileName = 'files-' . time() . '.zip';

        // Streamed response for downloading ZIP
        return new StreamedResponse(function () use ($fileUrls, $zipFileName) {
            // Set options for ZipStream
            $options = new Archive();
            $options->setSendHttpHeaders(true);
            $options->setContentDisposition('attachment; filename="' . $zipFileName . '"');

            // Initialize ZipStream
            $zip = new ZipStream(null, $options);

            foreach ($fileUrls as $fileUrl) {
                $fileName = basename($fileUrl);
                $baseUrlToSkip = 'https://s3.eu-central-1.amazonaws.com/fileupload.io/';
                $filePath = str_replace($baseUrlToSkip, '', $fileUrl);
                $filePath = urldecode($filePath);

                if (Storage::disk('s3')->exists($filePath)) {
                    // Stream the file content directly into the ZIP archive
                    $stream = Storage::disk('s3')->readStream($filePath);

                    $zip->addFileFromStream($fileName, $stream);
                    fclose($stream);
                } else {
                    Log::warning('File does not exist on S3: ' . $filePath);
                }
            }

            // Finalize the ZIP stream
            $zip->finish();
        }, 200, [
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="' . $zipFileName . '"',
        ]);
    }

    public function downloadZifp45(Request $request)
    {


        $filePaths = json_decode($request->input('files'));

        // Create a new ZipArchive instance
        $zip = new ZipArchive();
        $zipFileName = storage_path('app/public/files.zip');

        if ($zip->open($zipFileName, ZipArchive::CREATE) !== TRUE) {
            return response()->json(['error' => 'Unable to create ZIP file'], 500);
        }

        // Add each file from the file paths to the ZIP
        foreach ($filePaths as $filePath) {
            $fileName = basename($filePath);
            $baseUrlToSkip = 'https://s3.eu-central-1.amazonaws.com/fileupload.io/';
            $filePath = str_replace($baseUrlToSkip, '', $filePath);
            $filePath = urldecode($filePath);
            if (Storage::disk('s3')->exists($filePath)) {
                $fileContent = Storage::disk('s3')->get($filePath);
                $zip->addFromString($fileName, $fileContent);
            } else {
                Log::warning('File does not exist on S3: ' . $filePath);
            }
        }

        $zip->close();

        // Return the ZIP file for download
        return response()->download($zipFileName)->deleteFileAfterSend(true);


        $fileUrls = json_decode($request->input('files'));
        $zipFileName = 'files-' . time() . '.zip';
        $zipFilePath = storage_path('app/public/' . $zipFileName);
        // Create ZIP archive
        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE) !== true) {
            Log::error('Failed to create ZIP file');
            return response()->json(['error' => 'Failed to create ZIP file'], 500);
        }

        foreach ($fileUrls as $fileUrl) {
            $fileName = basename($fileUrl);
            $baseUrlToSkip = 'https://s3.eu-central-1.amazonaws.com/fileupload.io/';
            $filePath = str_replace($baseUrlToSkip, '', $fileUrl);
            $filePath = urldecode($filePath);
            if (Storage::disk('s3')->exists($filePath)) {
                $fileContent = Storage::disk('s3')->get($filePath);
                $zip->addFromString($fileName, $fileContent);
            } else {
                Log::warning('File does not exist on S3: ' . $filePath);
            }
        }

        $zip->close();

        // Verify file existence
        if (!file_exists($zipFilePath)) {
            Log::error('ZIP file not found after creation: ' . $zipFilePath);
            return response()->json(['error' => 'ZIP file not found'], 500);
        }

        // Return the ZIP file for download
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }


    public function createSubscriptions(Request $request)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));

        $user = Auth::user();


        $customer = $stripe->customers->create([
            'email' => $user->email,
            'name' => $user->name,
        ]);
        // Step 2: Attach payment method to the customer
        $stripe->paymentMethods->attach(
            $request->token, // Payment method from Stripe Elements
            ['customer' => $customer->id]
        );

        // Step 3: Set the default payment method for the customer
        $stripe->customers->update(
            $customer->id,
            ['invoice_settings' => ['default_payment_method' => $request->token]]
        );

        // Step 4: Create the subscription
        $subscription = $stripe->subscriptions->create([
            'customer' => $customer->id,
            'items' => [['price' => $request->plan]], // Use the price ID from the form
            'expand' => ['latest_invoice.payment_intent'], // Expand to get payment details
        ]);

        // Step 5: Check payment status
        $paymentIntent = $subscription->latest_invoice->payment_intent;

        if ($paymentIntent->status === 'succeeded') {
            $user->subscription_date = now();
            $user->save();
            return redirect()->route('payment.page')->with('success', 'Your payment was successful. Thank you for subscribing!');
        } else {

            return redirect()->route('payment.page')->with('error', 'Payment failed. Please try again.');
        }
    }

    /**
     * Handles the file upload
     *
     * @param Request $request
     *
     * @return JsonResponse
     *
     * @throws UploadMissingFileException
     * @throws UploadFailedException
     */
    public function store(Request $request)
    {


        $folderName = auth()->user() ? auth()->user()->email : 'default'; // Set folder name based on user email or 'default'
        $userId = auth()->user() ? auth()->user()->id : null; // Set user ID if user is authenticated, otherwise null
        $expiry_date =  $request->expiry_date ? $request->expiry_date : null; // Set user ID if user is authenticated, otherwise null
        $password = $request->password ? $request->password : null; // Set user ID if user is authenticated, otherwise nul
        $folder = Folder::query()->where([
            'name' => $folderName,  // Compare based on the name
        ])->first();

        if (!$folder) {
            $folder = Folder::create([
                'name' => $folderName,  // Compare based on the name
            ]);
        }

        $fileUpload = FileUpload::query()->where([
            'name' => $request->name,  // Compare based on the name
            'expires_at' => $expiry_date,
            'user_id' => $userId,
        ])->first();
        if (!$fileUpload) {
            $fileUpload = FileUpload::create([
                'name' => $request->name,
                'password' => $password,
                'expires_at' => $expiry_date,
                'user_id' => $userId,
                'folder_id' =>  $folder->id,
            ]);
        }

        // create the file receiver
        $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));

        // check if the upload is success, throw exception or return response you need
        if ($receiver->isUploaded() === false) {
            throw new UploadMissingFileException();
        }

        // receive the file
        $save = $receiver->receive();

        // // check if the upload has finished (in chunk mode it will send smaller files)
        // if ($save->isFinished()) {
        //     return $this->saveFileInS3($save->getFile(), $fileUpload);
        // }

        if ($save->isFinished()) {
            return $this->saveFileInS3($save->getFile(), $fileUpload);
        }


        // we are in chunk mode, lets send the current progress
        $handler = $save->handler();

        return response()->json([
            "done" => $handler->getPercentageDone(),
            'status' => true,
        ]);
    }


    protected function saveFileInS3(UploadedFile $file, $fileUpload)
    {
        // Generate a unique filename
        $fileName = $this->createFilename($file);

        // Use the user-specified folder name or default to "default_folder"
        $userFolder = $fileUpload->folder_name ? trim($fileUpload->folder_name, '/') : 'default_folder';

        // Build the S3 file path
        $filePath = "{$userFolder}/{$fileName}";

        // Upload the file to S3
        Storage::disk('s3')->putFileAs(
            dirname($filePath),
            $file,
            basename($filePath)
        );

        $isSubscribed = 0;

        if (auth()->user()) {
            if (!auth()->user()->subscription_date) {
                $isSubscribed = 0;
            }
            $expirationDate = \Carbon\Carbon::parse(auth()->user()->subscription_date)->addMonth();
            $isSubscribed = now()->lt($expirationDate) ? 1 : 0;
        } else {
            $isSubscribed = 0;
        }

        // Store the file information in the database
        TrackFile::create([
            'filepath' => Storage::disk('s3')->url($filePath),
            'file_upload_id' => $fileUpload->id,
            'is_premium' => $isSubscribed
        ]);

        return response()->json([
            'path' => Storage::disk('s3')->url(dirname($filePath)),
            'name' => $fileName,
            'mime_type' => $file->getMimeType(),
            'fileUpload_name' => $fileUpload->name
        ]);
    }

    public function showFilesByFolder()
    {


        $fileUpload = FileUpload::where('user_id', auth()->id())->pluck('id');
        $TrackFile = TrackFile::whereIn('file_upload_id', $fileUpload)
            ->paginate(10);
        return view('forder-files', compact('TrackFile'));
    }

    public function showAllFileFolder()
    {

        $fileUploads = Folder::query()
            ->with('trackFiles')->latest() // Ensure the trackFiles are loaded
            ->paginate(10);


        // Check if the user is a super-admin
        if (auth()->user() && auth()->user()->role == 'admin') {
            // Add logic to display the folder_name and file name
            foreach ($fileUploads as $fileUpload) {
                foreach ($fileUpload->trackFiles as $trackFile) {
                    // Extract folder_name and file name from the file path
                    $fileUpload->folder_name = $fileUpload->folder_name;
                    $trackFile->file_name = basename($trackFile->filepath);
                }
            }
        }


        return view('admin-files', compact('fileUploads'));
    }



    public function deleteFile($fileId)
    {

        // Find the file by its ID
        $trackFile = TrackFile::findOrFail($fileId);




        $baseUrlToSkip = 'https://s3.eu-central-1.amazonaws.com/fileupload.io/';
        $filePath = str_replace($baseUrlToSkip, '', $trackFile->filepath);
        $filePath = urldecode($filePath);
        // Check if the file exists in S3 and delete it
        if (Storage::disk('s3')->exists($filePath)) {
            Storage::disk('s3')->delete($filePath);
            //   return response()->json(['message' => 'File deleted successfully.'], 200);
        }

        // Delete the file record from the database
        $trackFile->delete();

        return redirect()->back()->with('success', 'File deleted successfully');
    }


    public function check(Request $request)
    {
        $user = auth()->user();
        if ($user == null) {
            return response()->json(['isSubscribed' => false]);
        } else {
            if (!$user->subscription_date) {
                return response()->json(['isSubscribed' => false]);
            }

            // Calculate the expiration date (1 month after subscription_date)
            $expirationDate = \Carbon\Carbon::parse($user->subscription_date)->addMonth();

            // Check if the current date is before the expiration date
            $isSubscribed = now()->lt($expirationDate);


            return response()->json(['isSubscribed' => $isSubscribed]);
        }

        // Check if the user has a subscription date

    }


    /**
     * Saves the file to S3 server
     *
     * @param UploadedFile $file
     *
     * @return JsonResponse
     */
    protected function saveFileToS3($file)
    {
        $fileName = $this->createFilename($file);
        $disk = Storage::disk('s3');

        // It's better to use streaming (laravel 5.4+)
        $disk->putFileAs('photos', $file, $fileName);

        // for older laravel
        // $disk->put($fileName, file_get_contents($file), 'public');

        $mime = str_replace('/', '-', $file->getMimeType());

        // We need to delete the file when uploaded to s3
        unlink($file->getPathname());

        return response()->json([
            'path' => $disk->url($fileName),
            'name' => $fileName,
            'mime_type' => $mime
        ]);
    }

    protected function saveFile(UploadedFile $file, $fileUpload)
    {

        $fileName = $this->createFilename($file);

        // Group files by mime type
        $mime = str_replace('/', '-', $file->getMimeType());

        // Group files by the date (week
        $dateFolder = date("Y-m-W");

        // Build the file path
        $filePath = "upload/{$mime}/{$dateFolder}";
        $finalPath = storage_path("app/public/" . $filePath);

        // move the file name
        $file->move($finalPath, $fileName);

        TrackFile::create([
            'filepath' => asset('storage/' . $filePath . '/' . $fileName),
            'file_upload_id' => $fileUpload->id,
        ]);

        return response()->json([
            'path' => asset('storage/' . $filePath),
            'name' => $fileName,
            'mime_type' => $mime,
            'fileUpload_name' => $fileUpload->name
        ]);
    }


    /**
     * Saves the file
     *
     * @param UploadedFile $file
     *
     * @return JsonResponse
     */
    protected function saveFile1(UploadedFile $file, $trackFile)
    {
        $fileName = $this->createFilename($file);

        $mime = str_replace('/', '-', $file->getMimeType());

        // Build the file path
        $filePath = "upload/{$trackFile->name}";
        $finalPath = storage_path("app/public/" . $filePath);

        // move the file name
        $file->move($finalPath, $fileName);

        // Retrieve the current list of uploaded files from the session
        $uploadedFiles = Session::get('uploaded_files', []);

        // Append the new file's name to the list
        if (!in_array($fileName, $uploadedFiles)) {
            $uploadedFiles[] = $fileName;
        }

        // Update the session with the new list
        Session::put('uploaded_files', $uploadedFiles);
        $uploadedFiles = Session::get('uploaded_files', []);
        // Update the TrackFile record with all file names as JSON
        $trackFile->update(['track_names' => json_encode($uploadedFiles)]);

        return response()->json([
            'path' => asset('storage/' . $filePath),
            'name' => $fileName,
            'mime_type' => $mime
        ]);
    }

    /**
     * Create unique filename for uploaded file
     * @param UploadedFile $file
     * @return string
     */
    protected function createFilename(UploadedFile $file)
    {
        return $file->getClientOriginalName();
    }
}
