<?php

namespace App\Services\Product;

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
        $result = $this->productVariantRepository->create(['ProductID' => $productVariant['ProductID'],
            'VariantName' => $productVariant['VariantName'], 'StockQuantity' => $productVariant['StockQuantity']]);
        $this->imageProductService->addImageVariants($productVariant['ProductID'], $result['VariantID']
            , $productVariant['Image']);
    }
}
