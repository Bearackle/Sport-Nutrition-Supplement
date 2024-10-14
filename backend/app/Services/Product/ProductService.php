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
    public function getProductDetail($id)
    {
        $product_data = $this->productRepository->getProductData($id);
        return $product_data;
    }
    public function insertNewProduct(array $product) : void{
        $product['PriceAfterSale'] = $product['Price']*($product['Sale']/100);
        $result =  $this->productRepository->create($product);
        $this->imageProductService->addImagesProduct($result['ProductID'],$product['Images']);
        event(new ProductCreated($result));
    }
    public function updateStockQuantity($productID,$stockQuantity) : void{
        $this->productRepository->insertStockQuantity($productID,$stockQuantity);
    }
    public function updateProduct($id, array $product): bool
    {
        $result = $this->productRepository->update($id, $product);
        $imageIndex = 0;
        foreach($product['Images'] as $image){
            $this->imageProductService->updateUploadedImage($product['ImageID.'.$imageIndex],$image);
            $imageIndex++;
        }
        if($result){
            return true;
        }
        return false;
    }
    public function deleteProduct($id): bool
    {
        $result = $this->productRepository->delete($id);
        if($result){
            return true;
        }
        return false;
    }
}
