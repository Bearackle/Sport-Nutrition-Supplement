<?php

namespace App\Services\Product;

use App\Http\Responses\ApiResponse;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;

class ProductService implements ProductServiceInterface{
    protected ProductRepositoryInterface $productRepository;
    protected ProductVariantServiceInterface $productVariantService;
    public function __construct(ProductRepositoryInterface $productRepository,
    CategoryRepositoryInterface $categoryRepository, ProductVariantServiceInterface
                                $productVariantService){
        $this->productRepository = $productRepository;
        $this->productVariantService = $productVariantService;
    }
    public function getAllProductAvailable(){
        return $this->productRepository->getAllAvailableProduct();
    }
    public function getHotProductBySale(){
        return $this->productRepository->getTop10ProductHighestSale();
    }
    public function getProductDetail($id) : ApiResponse
    {
        $product_data = $this->productRepository->getProductData($id);
        $variant_data = $this->productVariantService->getVariantsData($id);
        return new ApiResponse(200,$product_data->union($variant_data));
    }
    public function insertNewProduct(array $product) : ApiResponse{
        $result =  $this->productRepository->create($product);
        if(!$result) {
            return new ApiResponse(400, [], 'fail create product');
        }
        $VariantsIDInserted = array();
        foreach($product['variants'] as $variant){
            $variant['product_id'] = $result->id;
            $this->productVariantService->insertProductVariant($variant);
            $VariantsIDInserted[] = $variant->id;
        }
        return new ApiResponse(200,
            ['message' => 'success create product '.$product['ProductName'],
             'ProductID' => $result['ProductID'],
             'variantsID' => $VariantsIDInserted]);
    }
}
