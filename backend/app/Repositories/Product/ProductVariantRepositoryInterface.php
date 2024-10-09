<?php

namespace App\Repositories\Product;

use App\Repositories\Interfaces\RepositoryInterface;


interface ProductVariantRepositoryInterface extends RepositoryInterface{
    public function getVariantAvailableForProduct($productID);
    public function updateVariantStock($id,$attribute);
    public function findVariantByNameAndProduct($variantName,$productID);
}