<?php

namespace App\Repositories\Product;

use App\Models\ImageLinkModels\ProductImages;
use App\Repositories\BaseRepository;

class ProductImageRepository extends BaseRepository implements ProductImageRepositoryInterface
{
    public function getModel(): string
    {
        return ProductImages::class;
    }
}
