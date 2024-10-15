<?php

namespace App\Repositories\Product;

use App\Repositories\Interfaces\RepositoryInterface;

interface ProductImageRepositoryInterface extends RepositoryInterface
{
    public function deleteImageByProductID($productID);
}
