<?php

namespace App\Repositories\Product;

use App\Repositories\Interfaces\RepositoryInterface;


interface ProductRepositoryInterface extends RepositoryInterface{
    public function getHotProductByEachCategory(); 
    public function getHotProductSale();
    public function getProductByCategories($category);
    public function getProductByBrand($brand);
    public function searchProduct($productName);
    public function updateProductStockQuantity($id,$data);
    public function getProductByPriceRange($range); // minPrice, maxPrice
    public function getAllAvailableProduct();
}