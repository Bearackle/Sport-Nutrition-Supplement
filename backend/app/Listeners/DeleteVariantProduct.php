<?php

namespace App\Listeners;

use App\Events\ProductDeleted;
use App\Services\Product\ProductVariantServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeleteVariantProduct
{
    protected ProductVariantServiceInterface $productVariantService;
    /**
     * Create the event listener.
     */
    public function __construct(ProductVariantServiceInterface $productVariantService)
    {
        $this->productVariantService = $productVariantService;
    }

    /**
     * Handle the event.
     */
    public function handle(ProductDeleted $event): void
    {
        $event->product->variations()->delete();
    }
}
