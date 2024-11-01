<?php

namespace App\Services\Product;

use App\DTOs\InputData\ProductIntputData;
use App\DTOs\InputData\VariantInputData;

interface ProductVariantServiceInterface{
    public function getAllProductVariants(ProductIntputData $product);
    public function getVariantsData(ProductIntputData $product);
    public function insertProductVariant(VariantInputData $variant);
    public function insertDefaultTaste(VariantInputData $variant);
    public function updateProductVariant(VariantInputData $variant);
    public function deleteVariant(VariantInputData $variant);
}
