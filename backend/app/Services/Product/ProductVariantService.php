<?php

namespace App\Services\Product;

use App\Http\Responses\ApiResponse;
use App\Repositories\Product\ProductVariantRepository;
use App\Repositories\Product\ProductVariantRepositoryInterface;

class ProductVariantService implements ProductVariantServiceInterface
{
    protected ProductVariantRepositoryInterface $productVariantRepository;
    public function __construct(ProductVariantRepositoryInterface $productVariantRepository){
        $this->productVariantRepository = $productVariantRepository;
    }
    public function getAllProductVariants($productID){
        return $this->productVariantRepository->getVariantAvailableForProduct($productID);
    }
    public function getVariantsData($productID){
        return $this->productVariantRepository->getVariantsDataWithImage($productID);
    }
    public function insertProductVariant(array $productVariant) : ApiResponse{
        $result =  $this->productVariantRepository->create($productVariant);
        if(!$result){
            return new ApiResponse(401,[],'Fail to create product variant');
        }
        return new ApiResponse(200,[],
            'Success to create product variant '. $result->VariantName);
    }
}
