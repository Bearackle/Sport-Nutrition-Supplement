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
    public function getHotProductByEachCategory(){
        return; //
    }
    public function getAllAvailableProducts(): \Illuminate\Database\Eloquent\Builder
    {
        return (new \App\Models\Product)
            ->orderBy('updated_at','desc')
            ->with(['images' => function ($query) {
                $query->whereNull('VariantID')->where('IsPrimary',1);
            }]);
    }
    public function getTop10ProductHighestSale(): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\Product)->orderBy('Sale','desc')->take(10)->get();
    }
    public function getProductByCategories($categoryID): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\Product)->where('CategoryID',$categoryID)
        ->get();
    }
    public function searchProduct($string): void
    {
        return; //
    }
    public function getProductByBrand($brand): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\Product)->where('BrandID',$brand)->get();
    }
    public function getProductByPriceRange($range): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\Product)->where('PriceAfterSale',[$range['minPrice'],$range['maxPrice']])->get();
    }
    public function getProductData($id)
    {
        return (new \App\Models\Product)->with(['images' => function ($query) {
            $query->whereNull('VariantID');
        },'variations'])->find($id);
    }
    public function filterer(ProductFilter $filter)
    {
        return Product::Filter($filter);
    }

    public function increaseQuantity($productID, $quantity) : void
    {
        (new \App\Models\Product)->where('ProductID',$productID)
            ->increment('StockQuantity',$quantity);
    }
    public function decreaseQuantity($productID, $quantity) : void{
        (new \App\Models\Product)->where('ProductID',$productID)->decrement('StockQuantity',$quantity);
    }
    public function getCountQuantityOfProduct($productID): int{
        return $this->find($productID)->variations
            ->sum('StockQuantity');
    }
}
