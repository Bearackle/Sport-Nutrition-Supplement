<?php

namespace App\Services\Product;

use App\Events\ImageDeleted;
use App\Events\ProductVariantCreated;
use App\Events\ProductVariantDeleted;
use App\Http\Responses\ApiResponse;
use App\Repositories\Product\ProductVariantRepository;
use App\Repositories\Product\ProductVariantRepositoryInterface;
use App\Services\ImageService\ImageProductServiceInterface;
use App\Traits\ProductStockChecking;

class ProductVariantService implements ProductVariantServiceInterface
{
    use ProductStockChecking;
    protected ProductVariantRepositoryInterface $productVariantRepository;
    protected ImageProductServiceInterface $imageProductService;
    public function __construct(ProductVariantRepositoryInterface $productVariantRepository, ImageProductServiceInterface $imageProductService){
        $this->productVariantRepository = $productVariantRepository;
        $this->imageProductService = $imageProductService;
    }
    public function getAllProductVariants($productID){
        return $this->productVariantRepository->getVariantAvailableForProduct($productID);
    }
    public function getVariantsData($productID){
        return $this->productVariantRepository->getVariantsDataWithImage($productID);
    }
    public function insertProductVariant(array $productVariant): void
    {
        $result = $this->productVariantRepository->create($productVariant);
        $this->imageProductService->addImageVariants($productVariant['ProductID'], $result['VariantID']
            ,$productVariant['Image']);
        $this->createdProductVariant($productVariant['ProductID'],$productVariant['StockQuantity']);
    }
    public function updateProductVariant(array $productVariant): void
    {
        $variant = $this->productVariantRepository->find($productVariant['VariantID']);
        if($variant['StockQuantity'] < $productVariant['StockQuantity']){
            $this->deleteProductVariant($variant,$productVariant['StockQuantity'] - $variant['StockQuantity']);
        }
        else {
            $this->createdProductVariant($variant,$variant['StockQuantity'] - $productVariant['StockQuantity'] );
        }
        $this->productVariantRepository->update($productVariant['VariantID'],['ProductID' => $productVariant['ProductID']
            ,'VariantName' => $productVariant['VariantName']]);
    }
    public function deleteVariant($variantId): void
    {
        $variant = $this->productVariantRepository->find($variantId);
        $this->deleteProductVariant($variant['ProductID'],$variant['StockQuantity']);
        $this->productVariantRepository->delete($variantId);
    }
}
