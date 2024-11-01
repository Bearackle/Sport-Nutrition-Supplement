<?php

namespace App\Services\Product;

use App\DTOs\InputData\ProductIntputData;
use App\DTOs\OutputData\AdminData\ProductOutputData;
use App\DTOs\OutputData\UserData\UserProductOutputData;
use App\Filters\ProductFilter;
use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Traits\ProductStockChecking;
use Illuminate\Contracts\Container\BindingResolutionException;

class ProductService implements ProductServiceInterface{
    use ProductStockChecking;
    protected ProductRepositoryInterface $productRepository;
    protected ProductVariantServiceInterface $productVariantService;

    /**
     * @throws BindingResolutionException
     */
    public function __construct(ProductRepositoryInterface $productRepository,
                                ProductVariantServiceInterface $productVariantService,){
        $this->productRepository = $productRepository;
        $this->productVariantService = $productVariantService;
        $this->setDependency();
    }
    public function getProducts(){
       return $this->productRepository->getAllAvailableProducts();
    }
    public function getHotProductBySale(): \Illuminate\Contracts\Pagination\Paginator|\Illuminate\Support\Enumerable|array|\Illuminate\Support\Collection|\Illuminate\Support\LazyCollection|\Spatie\LaravelData\PaginatedDataCollection|\Illuminate\Pagination\AbstractCursorPaginator|\Spatie\LaravelData\CursorPaginatedDataCollection|\Spatie\LaravelData\DataCollection|\Illuminate\Pagination\AbstractPaginator|\Illuminate\Contracts\Pagination\CursorPaginator
    {
        return ProductOutputData::collect($this->productRepository->getTop10ProductHighestSale());
    }
    public function getProductDetail(ProductIntputData $product) : ProductOutputData
    {
        return ProductOutputData::from($this->productRepository->getProductData($product->product_id));
    }
    public function insertNewProduct(ProductIntputData $product): ProductOutputData {
        $product['price_after_sale'] = $this->calculatedPrice($product['price'],$product['sale']);
        return ProductOutputData::from($this->productRepository->create($product));
    }
    public function updateProduct(ProductIntputData $product) : bool | ProductOutputData
    {
        if(property_exists($product, 'stock_quantity')){
            $isAllowed = $this->updatedProductStock($product->product_id, $product->stock_quantity);
            if(!$isAllowed) {
                return false;
            }
        }
        return ProductOutputData::from($this->productRepository->update($product->product_id, $product));
    }
    public function deleteProduct(ProductIntputData $product) : bool
    {
        // event(new ProductDeleted($product));
        return $this->productRepository->delete($product->product_id);
    }
    public function filter(ProductFilter $filters)
    {
        return $this->productRepository->filterer($filters);
    }
    public function getCategoryProduct(ProductIntputData $product) {
        return $this->productRepository->getProductsByCategories($product->category_id);
    }
    public function getModelProduct(ProductIntputData $product) {
        return $this->productRepository->find($product->product_id);
    }
    public function calculatedPrice($price,$sale) : int{
            return $price * ((100.0-$sale)/100.0);
    }
}
