<?php

namespace App\Services\Product;

use App\DTOs\InputData\CategoryInputData;
use App\DTOs\InputData\ProductIntputData;
use App\DTOs\OutputData\ProductOutputData;
use App\Filters\ProductFilter;
use App\Models\Category;
use App\Models\Combo;
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
    public function getProducts()
    {
       return $this->productRepository->getAllAvailableProducts()->paginate(10);
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
        $product->price_after_sale = $this->calculatedPrice($product->price,$product->sale);
        return ProductOutputData::from($this->productRepository->create($product->toArray()));
    }
    public function updateProduct(ProductIntputData $product) : bool | ProductOutputData
    {
        if($product->has('stock_quantity')){
            $isAllowed = $this->updatedProductStock($product->product_id, $product->stock_quantity);
            if(!$isAllowed) {
                return false;
            }
        }
        return ProductOutputData::from($this->productRepository->update($product->product_id, $product->toArray()));
    }
    public function deleteProduct(ProductIntputData $product) : bool
    {
        $product =$this->productRepository->find($product->product_id);
        $product->stock_quantity = -1; // coi như bị xóa, sẽ xử lý sau
        $product->save();
        $product->variants()->update(['stock_quantity' => -1]); // cập nhật quantity của các variants của product
        //return $this->productRepository->delete($product); xử ly sau
        return true;
    }
    public function filter(ProductFilter $filters)
    {
        return $this->productRepository->filterer($filters);
    }
    public function getCategoryProduct(CategoryInputData $category)
    {
        return $this->productRepository->getProductsByCategories($category->category_id)->paginate(10);
    }
    public function getModelProduct(ProductIntputData $product) {
        return $this->productRepository->find($product->product_id);
    }
    public function calculatedPrice($price,$sale) : int{
            return $price * ((100.0-$sale)/100.0);
    }

    public function search($data)
    {
        if ($data != '') {
            $products = Product::fullTextSearch('product_name', $data);
            return $products->paginate(10);
        }
        return null;
    }
}
