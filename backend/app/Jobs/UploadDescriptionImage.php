<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class UploadDescriptionImage implements ShouldQueue
{
    use Queueable;
    protected string $filePath;
    protected array $data;
    /**
     * Create a new job instance.
     */
    public function __construct(string $filePath,array $data)
    {
        $this->filePath = $filePath;
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

    }
}
