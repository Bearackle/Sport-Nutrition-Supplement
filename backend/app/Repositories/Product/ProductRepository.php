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
    public function getAllAvailableProducts(): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\Product)->whereNot('StockQuantity',0)
            ->orderBy('updated_at','desc')
            ->with(['images' => function ($query) {
                $query->whereNull('VariantID')->where('IsPrimary',1);
            }])->get();
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
        return (new \App\Models\Product)->with(['images' => function($query){
            $query->whereNull('VariantID');
        }])->find($id);
    }
    public function insertStockQuantity($productID, $quantity): false|int
    {
        return $this->find($productID)->increment('StockQuantity',$quantity);
    }
}
