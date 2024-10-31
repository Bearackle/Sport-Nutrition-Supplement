<?php

namespace App\Repositories\Product;

use App\Repositories\Interfaces\RepositoryInterface;


interface ProductVariantRepositoryInterface extends RepositoryInterface{
    public function getVariantAvailableForProduct($productId);
    public function getVariantsDataWithImage($productId);
    public function findVariantByNameAndProduct($variantName,$productId);
}
