<?php

namespace App\Services\Product;

use App\Events\ImageDeleted;
use App\Events\ProductVariantCreated;
use App\Events\ProductVariantDeleted;
use App\Http\Responses\ApiResponse;
use App\Repositories\Product\ProductVariantRepository;
use App\Repositories\Product\ProductVariantRepositoryInterface;
use App\Services\ImageService\ImageProductServiceInterface;

class ProductVariantService implements ProductVariantServiceInterface
{
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
        event(new ProductVariantCreated($result));
    }
    public function updateProductVariant(array $productVariant): bool
    {
        $resultDb =  $this->productVariantRepository->update($productVariant['ProductID'],$productVariant);
        $resultImage = $this->imageProductService->updateUploadedImage($productVariant['ImageId'], $productVariant[
            'Image']);
        if(!$resultDb){
            return false;
        }
        return true;
    }
    public function deleteVariant($variantId): bool
    {
        $variant = $this->productVariantRepository->find($variantId);
        event(new ProductVariantDeleted($variant));
        $result = $this->productVariantRepository->delete($variantId);
        if(!$result){
            return false;
        }
        return true;
    }
}
