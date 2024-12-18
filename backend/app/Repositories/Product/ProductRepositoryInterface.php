<?php

namespace App\Repositories\Product;

use App\Repositories\Interfaces\RepositoryInterface;


interface ProductRepositoryInterface extends RepositoryInterface{
    public function getHotProductByEachCategory();
    public function getTop10ProductHighestSale();
    public function getProductsByCategories($categoryId);
    public function getProductByBrand($brand);
    public function searchProduct($productName);
    public function getProductByPriceRange($range); // minPrice, maxPrice
    public function getAllAvailableProducts();
    public function getProductData($id);
    public function increaseQuantity($productId, $quantity);
    public function decreaseQuantity($productId, $quantity);
}
