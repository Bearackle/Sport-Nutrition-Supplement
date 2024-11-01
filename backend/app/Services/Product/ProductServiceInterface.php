<?php

namespace App\Services\Product;

use App\DTOs\InputData\ProductIntputData;
use App\Filters\ProductFilter;

interface ProductServiceInterface{
    public function getProducts();
    public function getHotProductBySale();
    public function getProductDetail(ProductIntputData $product);
    public function insertNewProduct(ProductIntputData $product);
    public function updateProduct(ProductIntputData $product);
    public function deleteProduct(ProductIntputData $product);
    public function filter(ProductFilter $filters);
    public function getCategoryProduct(ProductIntputData $product);
    public function getModelProduct(ProductIntputData $product);
}
