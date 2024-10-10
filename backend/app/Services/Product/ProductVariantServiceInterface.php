<?php

namespace App\Services\Product;

interface ProductVariantServiceInterface{
    public function getAllProductVariants($productID);
    public function getVariantsData($productID);
    public function insertProductVariant( array $productVariant);
}
