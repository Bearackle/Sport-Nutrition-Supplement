<?php

namespace App\Traits;

use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Product\ProductVariantRepositoryInterface;
use Illuminate\Contracts\Container\BindingResolutionException;

trait ProductStockChecking
{
    protected ProductRepositoryInterface $productRepository;
    protected ProductVariantRepositoryInterface $productVariantRepository;

    /**
     * @throws BindingResolutionException
     */
    public function setDependency() : void
    {
        $this->productRepository = app()->make(ProductRepositoryInterface::class);
        $this->productVariantRepository = app()->make(ProductVariantRepositoryInterface::class);
    }
    public function updatedProductStock($productId, $quantity) : bool {
        $countProducts = $this->productRepository->getCountQuantityOfProduct($productId);
        return $countProducts < $quantity;
    }
    public function createdProductVariant($productVariant, $quantity) : void {
        $this->productRepository->increaseQuantity($productVariant->product_id, $quantity);
    }
    public function updateVariantStock($productVariant, $quantity) : void{
        $countProduct = abs($productVariant->stock_quantity - $quantity);
        if($productVariant->stock_quantity < $quantity){
            $this->productVariantRepository->increaseStock($productVariant->variant_id, $countProduct);
            $this->createdProductVariant($productVariant, $countProduct);
        }
        else {
            $this->productVariantRepository->decreaseStock($productVariant->variant_id, $countProduct);
            $this->deleteProductVariant($productVariant, $countProduct);
        }
    }
    public function deleteProductVariant($productVariant ,$quantity) : void {
        $this->productRepository->decreaseQuantity($productVariant->product_id, $quantity);
    }
    public function soldProductVariants($variantId, $quantity) : void {
        $variant = $this->productVariantRepository->find($variantId);
        $this->productRepository->decreaseQuantity($variant->product_id, $quantity);
        $this->productVariantRepository->decreaseStock($variant->product_id, $quantity);
    }
    public function soldProduct($productId, $quantity) : void {
        $this->productRepository->increaseQuantity($productId, $quantity);
    }

    /**
     * @throws \Exception
     */
    public function returnQuantity($variantIdsWithQuantity): void
    {
        foreach ($variantIdsWithQuantity as $variantId => $quantity){
            $variant = $this->productVariantRepository->find($variantId);
            if(!$variant)
                throw new \Exception("Variant not found");
            $variant->update(['stock_quantity' => $variant->stock_quantity + $quantity]);
            $this->productRepository->increaseQuantity($variant->product_id, $quantity);
        }
    }
}
