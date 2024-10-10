<?php

namespace App\Repositories\Product;

use App\Repositories\Interfaces\RepositoryInterface;


interface ProductRepositoryInterface extends RepositoryInterface{
    public function getHotProductByEachCategory();
    public function getTop10ProductHighestSale();
    public function getProductByCategories($categoryID);
    public function getProductByBrand($brand);
    public function searchProduct($productName);
    public function getProductByPriceRange($range); // minPrice, maxPrice
    public function getAllAvailableProduct();
    public function getProductData($id);
}
