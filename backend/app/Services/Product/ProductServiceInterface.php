<?php

namespace App\Services\Product;

interface ProductServiceInterface{
    public function getAllProductAvailable();
    public function getHotProductBySale();
    public function getProductDetail($id);
    public function insertNewProduct(array $product);
    public function updateProduct($id, array $product);
    public function deleteProduct($id);
}
