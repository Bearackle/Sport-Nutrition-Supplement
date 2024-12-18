<?php

namespace App\Listeners;

use App\Events\ImageDeleted;
use App\Events\ProductVariantDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeleteImageProductVariant
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProductVariantDeleted $event): void
    {
        $image = $event->productVariant->image;
        event(new ImageDeleted($image));
        $event->productVariant->image()->delete();
    }
}
