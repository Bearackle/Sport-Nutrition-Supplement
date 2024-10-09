<?php 

namespace App\Services\Product;

interface ProductServiceInterface{
    public function getProductOfCategory($category);
    public function getProductOfChildCategory(array $categoryTrace);
    public function getAllProductAvailable();
    public function insertNewProduct($product);
}