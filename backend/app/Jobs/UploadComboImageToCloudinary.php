<?php

namespace App\Jobs;

use App\Repositories\Combo\ComboRepositoryInterface;
use App\Services\ImageService\ImageProductService;
use Cloudinary\Api\Exception\ApiError;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UploadComboImageToCloudinary implements ShouldQueue
{
    use Queueable;
    protected array $data;
    protected string $filePath;
    protected ComboRepositoryInterface $comboRepository;
    /**
     * Create a new job instance.
     */
    public function __construct(string $filePath,array $data, ComboRepositoryInterface $comboRepository)
    {
        $this->filePath = $filePath;
        $this->data = $data;
        $this->comboRepository = $comboRepository;
    }
    /**
     * Execute the job.
     * @throws ApiError
     */
    public function handle(): void
    {
        $uploaded = cloudinary()->upload(Storage::path($this->filePath));
        $this->data['combo_image_url'] = $uploaded->getSecurePath();
        $this->comboRepository->update($this->data['combo_id'],$this->data);
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
