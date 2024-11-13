<?php

namespace App\Jobs;

use Cloudinary\Api\Exception\ApiError;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UploadToCloudinary implements ShouldQueue
{
    use Queueable;
    protected string $filePath;
    protected array $data;
    /**
     * Create a new job instance.
     */
    public function __construct(string $path,array $data)
    {
        $this->filePath = $path;
        $this->data = $data;
    }

    /**
     * Execute the job.
     * @throws ApiError
     */
    public function handle(): void
    {
        $uploaded = cloudinary()->upload(Storage::path($this->filePath),[
            'publicId' => $this->data['public_id'],
            'overwrite' => true,
        ]);
        Storage::delete($this->filePath);
    }
    public function fail($exception = null) : void
    {
        Log::error('Job failed', [
            'message' => $exception ? $exception->getMessage() : 'Unknown error',
            'exception' => $exception ? $exception->getTraceAsString() : null,
            'file_path' => $this->filePath,
            'data' => $this->data,
        ]);
    }
}
