<?php

namespace App\Listeners;

use App\Events\ImageDeleted;
use App\Events\ProductDeleted;
use App\Services\ImageService\ImageProductServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Nette\Utils\Image;

class DeleteImageProduct
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
    public function handle(ProductDeleted $event): void
    {
        $images = $event->product->images();
        foreach ($images as $image) {
            event(new ImageDeleted($image));
        }
        $event->product->images()->delete();
    }
}
