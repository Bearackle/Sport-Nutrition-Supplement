<?php

namespace App\Repositories\Product;

use App\Repositories\Interfaces\RepositoryInterface;


interface ProductVariantRepositoryInterface extends RepositoryInterface{
    public function getVariantAvailableForProduct($productID);
    public function getVariantsDataWithImage($productID);
    public function findVariantByNameAndProduct($variantName,$productID);
}
