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
    public function createdProductVariant($productVariant, $quantity) : void{
        $this->productRepository->increaseQuantity($productVariant['ProductID'], $quantity);
    }
    public function updateVariantStock($productVariant, $quantity) : void{
        $countProduct = abs($productVariant - $quantity);
        if($productVariant->StockQuantity > $quantity){
            $this->productVariantRepository->increaseStock($productVariant, $countProduct);
            $this->createdProductVariant($productVariant, $countProduct);
        }
        else {
            $this->productVariantRepository->decreaseStock($productVariant, $countProduct);
            $this->deleteProductVariant($productVariant, $countProduct);
        }
    }
    public function deleteProductVariant($productVariant ,$quantity) : void {
        $this->productRepository->decreaseQuantity($productVariant['ProductID'], $quantity);
    }
    public function soldProductVariants($variantID, $quantity) : void {
        $variant = $this->productVariantRepository->find($variantID);
        $this->productRepository->decreaseQuantity($variant['ProductID'], $quantity);
        $this->productVariantRepository->decreaseStock($variant['ProductID'], $variant['StockQuantity']);
    }
    public function soldProduct($productId, $quantity) : void {
        $this->productRepository->increaseQuantity($productId, $quantity);
    }
}
