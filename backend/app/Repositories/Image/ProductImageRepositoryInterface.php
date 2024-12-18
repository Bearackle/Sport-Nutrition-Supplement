<?php

namespace App\Repositories\Image;

use App\Repositories\Interfaces\RepositoryInterface;

interface ProductImageRepositoryInterface extends RepositoryInterface
{
    public function deleteImageByProductID($productId);
    public function getDefaultImageByProductID($productId);
}
