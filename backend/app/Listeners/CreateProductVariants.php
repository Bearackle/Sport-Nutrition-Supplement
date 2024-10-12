<?php

namespace App\Listeners;

use App\Events\ProductCreated;
use App\Http\Requests\NewProductRequest;
use App\Models\ProductVariant;
use App\Services\ImageService\ImageProductServiceInterface;
use App\Services\Product\ProductVariantServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateProductVariants
{
    /**
     * Create the event listener.
     */
    protected ProductVariantServiceInterface $productVariantService;
    protected ImageProductServiceInterface $imageProductService;
    protected NewProductRequest $request;
    public function __construct(ProductVariantServiceInterface $productVariantService,
                                NewProductRequest $request, ImageProductServiceInterface $imageProductService)
    {
        $this->productVariantService = $productVariantService;
        $this->request = $request;
        $this->imageProductService = $imageProductService;
    }

    /**
     * Handle the event.
     */
    public function handle(ProductCreated $event): void
    {
        $variants = $this->request['Variants']->validate();
        foreach ($variants as $variant) {
            $variant['ProductID'] = $event->product['ProductID'];
            $variantData = array_merge($variant,$this->request->file('Variants.{$loop->index}.Image'));
            $this->productVariantService->insertProductVariant($variantData);
        }
    }
}
