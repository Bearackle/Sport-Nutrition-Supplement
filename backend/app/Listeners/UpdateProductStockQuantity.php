<?php

namespace App\Listeners;

use App\Events\ProductVariantCreated;
use App\Services\Product\ProductServiceInterface;
use App\Services\Product\ProductVariantServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateProductStockQuantity
{
    /**
     * Create the event listener.
     */
    protected ProductServiceInterface $productService;
    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }
    /**
     * Handle the event.
     */
    public function handle(ProductVariantCreated $event): void
    {
        $this->productService->updateStockQuantity
        ($event->productVariant['ProductID'],$event->productVariant['StockQuantity']);
    }
}
