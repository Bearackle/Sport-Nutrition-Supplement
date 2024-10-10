<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;


class ProductRepository extends BaseRepository implements ProductRepositoryInterface {
    public function getModel(): string
    {
        return Product::class;
    }
    public function getHotProductByEachCategory(){
        return; //
    }
    public function getAllAvailableProduct(): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\Product)->whereNot('StockQuantity',0)
        ->orderBy('updated_at','desc')
        ->get();
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
    public function getProductData($id): \Illuminate\Database\Eloquent\Collection
    {
        return $product = (new \App\Models\Product)->with('images')
            ->find($id);
    }
}
