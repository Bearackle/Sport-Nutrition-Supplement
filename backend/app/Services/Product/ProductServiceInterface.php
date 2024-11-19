<?php

namespace App\Services\Product;

use App\DTOs\InputData\CategoryInputData;
use App\DTOs\InputData\ProductIntputData;
use App\Filters\ProductFilter;
use App\Models\Category;

interface ProductServiceInterface{
    public function getProducts();
    public function getHotProductBySale();
    public function getProductDetail(ProductIntputData $product);
    public function insertNewProduct(ProductIntputData $product);
    public function updateProduct(ProductIntputData $product);
    public function deleteProduct(ProductIntputData $product);
    public function filter(ProductFilter $filters);
    public function getCategoryProduct(CategoryInputData $category);
    public function getModelProduct(ProductIntputData $product);
    public function search($data);
}
