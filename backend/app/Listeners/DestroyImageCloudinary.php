<?php

namespace App\Listeners;

use App\Events\ImageDeleted;
use App\Services\ImageService\ImageProductServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DestroyImageCloudinary
{
    protected ImageProductServiceInterface $imageProductService;
    /**
     * Create the event listener.
     */
    public function __construct(ImageProductServiceInterface $imageProductService)
    {
        $this->imageProductService = $imageProductService;
    }

    /**
     * Handle the event.
     */
    public function handle(ImageDeleted $event): void
    {
        $this->imageProductService->deleteImage($event->image);
    }
}
