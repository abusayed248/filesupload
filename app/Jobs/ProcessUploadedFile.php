<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\UploadedFile;

class ProcessUploadedFile implements ShouldQueue
{
    use Dispatchable, Batchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $fileUpload;
    protected $filePath;

    public function __construct($fileUpload, $filePath)
    {
        $this->fileUpload = $fileUpload;
        $this->filePath = $filePath;  // Store the file path instead of the UploadedFile instance
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        try {
            // Recreate the UploadedFile instance from the file path
            $file = new UploadedFile($this->filePath, basename($this->filePath));

            // Add the file to media collection
            $this->fileUpload->addMedia($file)->toMediaCollection('uploads');
        } catch (\Exception $e) {
            Log::error("Failed to process file: {$e->getMessage()}");
            throw new \Exception("Failed to process file: {$e->getMessage()}");
        }
    }
}
