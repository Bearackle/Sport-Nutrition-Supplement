<?php

namespace App\Traits;

use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Product\ProductVariantRepositoryInterface;

trait ProductStockChecking
{
    protected ProductRepositoryInterface $productRepository;
    protected ProductVariantRepositoryInterface $productVariantRepository;
    public function __construct(ProductRepositoryInterface $productRepository, ProductVariantRepositoryInterface $productVariantRepository)
    {
        $this->productRepository = $productRepository;
        $this->productVariantRepository = $productVariantRepository;
    }
    public function updatedProductStock($productId, $quantity) : bool {
        $countProducts = $this->productRepository->getCountQuantityOfProduct($productId);
        return $countProducts < $quantity;
    }
    public function createdProductVariant($productVariant, $quantity) : void{
        $this->productVariantRepository->increaseStock($productVariant, $quantity);
        $this->productRepository->increaseQuantity($productVariant['ProductID'], $productVariant['StockQuantity']);
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
