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
    public function getAllAvailableProducts();
    public function getProductData($id);
    public function increaseQuantity($productID, $quantity);
    public function decreaseQuantity($productID, $quantity);
}
