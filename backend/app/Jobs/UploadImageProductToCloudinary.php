<?php

namespace App\Jobs;

use App\Services\ImageService\ImageProductService;
use Cloudinary\Api\Exception\ApiError;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Exception;
use phpDocumentor\Reflection\Types\Boolean;

class UploadImageProductToCloudinary implements ShouldQueue
{
    use Queueable;
    public string $filePath;
    public array $data;
    protected ImageProductService $imageProductService;
    public int $tries = 2;
    /**
     * Create a new job instance.
     */
    public function __construct(string $filePath,array $data,ImageProductService $imageProductService)
    {
        $this->filePath = $filePath;
        $this->data = $data;
        $this->imageProductService = $imageProductService;
    }
    /**
     * Execute the job.
     * @throws ApiError
     */
    public function handle(): void
    {
            $uploaded = cloudinary()->upload(Storage::path($this->filePath));
            $this->data['image_url'] = $uploaded->getSecurePath();
            $this->data['public_id'] = $uploaded->getPublicId();
            $this->imageProductService->storeDBImageProducts($this->data);
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
