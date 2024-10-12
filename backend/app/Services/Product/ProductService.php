<?php

namespace App\Services\Product;

use App\Events\ProductCreated;
use App\Http\Responses\ApiResponse;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Services\ImageService\ImageProductServiceInterface;

class ProductService implements ProductServiceInterface{
    protected ProductRepositoryInterface $productRepository;
    protected ProductVariantServiceInterface $productVariantService;
    protected ImageProductServiceInterface $imageProductService;
    public function __construct(ProductRepositoryInterface $productRepository,
    CategoryRepositoryInterface $categoryRepository, ProductVariantServiceInterface $productVariantService,
    ImageProductServiceInterface $imageProductService){
        $this->productRepository = $productRepository;
        $this->productVariantService = $productVariantService;
        $this->imageProductService = $imageProductService;
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
    public function insertNewProduct(array $product) : void{
        $product['PriceAfterSale'] = $product['Price']*($product['Sale']/100);
        $result =  $this->productRepository->create($product);
        $this->imageProductService->addImagesProduct($result['ProductID'],$product['Images']);
        event(new ProductCreated($result['ProductID']));
    }
}
