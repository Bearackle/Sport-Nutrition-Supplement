<?php

namespace App\Services\Product;

use App\Events\ProductCreated;
use App\Events\ProductDeleted;
use App\Filters\ProductFilter;
use App\Http\Responses\ApiResponse;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Services\ImageService\ImageProductServiceInterface;
use App\Traits\ProductStockChecking;
use Illuminate\Contracts\Container\BindingResolutionException;

class ProductService implements ProductServiceInterface{
    use ProductStockChecking;
    protected ProductRepositoryInterface $productRepository;
    protected ProductVariantServiceInterface $productVariantService;

    /**
     * @throws BindingResolutionException
     */
    public function __construct(ProductRepositoryInterface     $productRepository,
                                ProductVariantServiceInterface $productVariantService,){
        $this->productRepository = $productRepository;
        $this->productVariantService = $productVariantService;
        $this->setDependency();
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
    public function insertNewProduct(array $product){
        $product['PriceAfterSale'] = $this->calculatedPrice($product['Price'],$product['Sale']);
        return $this->productRepository->create($product);
    }
    public function updateProduct($id, array $product) : bool
    {
        $isAllowed = $this->updatedProductStock($id, $product['StockQuantity']);
        if(!$isAllowed) {
            return false;
        }
        $this->productRepository->update($id, $product);
        return true;
    }
    public function deleteProduct($id): bool
    {
        $product = $this->productRepository->find($id);
        event(new ProductDeleted($product));
        $result = $this->productRepository->delete($id);
        return $result ??= null;
    }
    public function filter(ProductFilter $filters)
    {
        return $this->productRepository->filterer($filters);
    }
    public function getCategoryProduct($id){
        return $this->productRepository->getProductByCategories($id);
    }
    public function getModelProduct($id){
        return $this->productRepository->find($id);
    }
    public function calculatedPrice($price,$sale) : int{
            return $price * ((100.0-$sale)/100.0);
    }
}
