<?php

namespace App\Listeners;

use App\Events\ProductVariantDeleted;
use App\Services\Product\ProductService;
use App\Services\Product\ProductServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateProductStockQuantity
{
    protected ProductServiceInterface $productService;
    /**
     * Create the event listener.
     */
    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Handle the event.
     */
    public function handle(ProductVariantDeleted $event): void
    {
        $this->productService->getModelProduct($event->productVariant['ProductID'])
            ->decrement('StockQuantity',$event->productVariant['StockQuantity']);
    }
}
