<?php

namespace App\Services\Product;

use App\Filters\ProductFilter;

interface ProductServiceInterface{
    public function getProducts();
    public function getHotProductBySale();
    public function getProductDetail($id);
    public function insertNewProduct(array $product);
    public function updateProduct($id, array $product);
    public function deleteProduct($id);
    public function filter(ProductFilter $filters);
    public function getCategoryProduct($id);
    public function getModelProduct($id);
}
