<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;


class ProductRepository extends BaseRepository implements ProductRepositoryInterface {
    public function getModel(){
        return Product::class;
    }
    public function getHotProductByEachCategory(){
        return; //
    }
    public function getAllAvailableProduct(){
        return Product::where('StockQuantity')
        ->orderBy('updated_at','desc')
        ->get();
    }
    public function getHotProductSale(){
        return Product::orderBy('Sale','desc')->take(10)->get();
    }
    public function getProductByCategories($categoryID){
        return Product::where('CategoryID',$categoryID)
        ->get();
    }
    public function searchProduct($string){
        return; // 
    }
    public function updateProductStockQuantity($id,$data){
        return $this->update($id,$data);
    }
    public function getProductByBrand($brand){
        return Product::where('BrandID',function($query){
            $query->select('*')
            ->from('brands')
            ->where('BrandName',$brand);
        });
    }
    public function getProductByPriceRange(array $range){
        return Product::where('PriceAfterSale',[$range['minPrice'],$range['maxPrice']])->get();
    }
}