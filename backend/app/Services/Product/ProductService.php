<?php

namespace App\Services\Product;

use App\Events\ProductCreated;
use App\Events\ProductDeleted;
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
    public function getProducts(){
       return $this->productRepository->getAllAvailableProducts();
    }
    public function getHotProductBySale(){
        return $this->productRepository->getTop10ProductHighestSale();
    }
    public function getProductDetail($id)
    {
        return $this->productRepository->getProductData($id);
    }
    public function insertNewProduct(array $product) : bool{
        $product['PriceAfterSale'] = $product['Price']*($product['Sale']/100);
        $result =  $this->productRepository->create($product);
        $this->imageProductService->addImagesProduct($result['ProductID'],$product['Images']);
        event(new ProductCreated($result));
        return true;
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
        $product = $this->productRepository->find($id);
        event(new ProductDeleted($product));
        $result = $this->productRepository->delete($id);
        if($result){
            return true;
        }
        return false;
    }
}
