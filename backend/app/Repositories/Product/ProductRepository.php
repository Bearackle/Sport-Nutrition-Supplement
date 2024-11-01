<?php

namespace App\Repositories\Product;

use App\Filters\ProductFilter;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Repositories\BaseRepository;


class ProductRepository extends BaseRepository implements ProductRepositoryInterface {
    public function getModel(): string
    {
        return Product::class;
    }
    public function getHotProductByEachCategory()
    {
        return; //
    }
    public function getAllAvailableProducts(): \Illuminate\Database\Eloquent\Builder
    {
        return (new \App\Models\Product)
            ->orderBy('updated_at','desc')
            ->with(['images' => function ($query) {
                $query->whereNull('variant_id')->where('is_primary',1);
            }]);
    }
    public function getTop10ProductHighestSale(): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\Product)->orderBy('sale','desc')->take(10)->get();
    }
    public function getProductsByCategories($categoryId): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\Product)->where('category_id',$categoryId)
        ->get();
    }
    public function searchProduct($string): void
    {
        return; //
    }
    public function getProductByBrand($brand): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\Product)->where('brand_id',$brand)->get();
    }
    public function getProductByPriceRange($range): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\Product)->where('price_after_sale',[$range['minPrice'],$range['maxPrice']])->get();
    }
    public function getProductData($id)
    {
        return (new \App\Models\Product)->with(['images' => function ($query) {
            $query->whereNull('variant_id');
        },'variants'])->find($id);
    }
    public function filterer(ProductFilter $filter)
    {
        return Product::Filter($filter);
    }

    public function increaseQuantity($productId, $quantity) : void
    {
        (new \App\Models\Product)->where('product_id',$productId)
            ->increment('stock_quantity',$quantity);
    }
    public function decreaseQuantity($productId, $quantity) : void{
        (new \App\Models\Product)->where('product_id',$productId)->decrement('stock_quantity',$quantity);
    }
    public function getCountQuantityOfProduct($productID): int{
        return $this->find($productID)->variants
            ->sum('stock_quantity');
    }
}
