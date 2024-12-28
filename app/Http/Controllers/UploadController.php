<?php

namespace App\Http\Controllers;

use App\Models\TrackFile;
use App\Models\FileUpload;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Exceptions\UploadFailedException;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;

class UploadController extends Controller
{
    public function index()
    {
        return view('upload');
    }


    public function storeFilePaths(Request $request)
    {

        dd($request->all());
        // Validate the incoming file paths
        $request->validate([
            'file_paths' => 'required|array',
            'file_paths.*' => 'string', // Ensure each path is a string
        ]);

        // Create a unique name for this file path entry
        $uniqueName = uniqid(); // Unique identifier for this set of file paths

        // Store the file paths in the database (you can store them as a JSON array or a text field)
        $filePath = new FilePath();
        $filePath->unique_name = $uniqueName; // Store the unique name
        $filePath->paths = json_encode($request->file_paths); // Store the file paths as JSON
        $filePath->save();

        return response()->json([
            'message' => 'File paths saved successfully',
            'unique_name' => $uniqueName, // Return the unique name for reference
        ]);
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

        $fileUpload = FileUpload::query()->where([
            'name' => $request->name,  // Compare based on the name
            'expires_at' => $request->expiry_date,
        ])->first();
        if (!$fileUpload) {
            $fileUpload = FileUpload::create([
                'name' => $request->name,
                'password' => $request->password ? $request->password : null,
                'expires_at' => $request->expiry_date,
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

        // check if the upload has finished (in chunk mode it will send smaller files)
        if ($save->isFinished()) {
            return $this->saveFile($save->getFile(), $fileUpload);
        }



        // we are in chunk mode, lets send the current progress
        $handler = $save->handler();

        return response()->json([
            "done" => $handler->getPercentageDone(),
            'status' => true,
        ]);
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
        $extension = $file->getClientOriginalExtension();
        $filename = str_replace("." . $extension, "", $file->getClientOriginalName()); // Filename without extension

        // Add timestamp hash to name of the file
        $filename .= "_" . md5(time()) . "." . $extension;

        return $filename;
    }
}
