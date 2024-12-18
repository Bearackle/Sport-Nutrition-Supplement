<?php

namespace App\Repositories\Image;

use App\Models\ImageLinkModels\ProductImages;
use App\Repositories\BaseRepository;

class ProductImageRepository extends BaseRepository implements ProductImageRepositoryInterface
{
    public function getModel(): string
    {
        return ProductImages::class;
    }
    public function deleteImageByProductID($productId){
    }

    public function getDefaultImageByProductID($productId)
    {
       return (new \App\Models\ImageLinkModels\ProductImages)->where('product_id', $productId)
           ->where('variant_id', null)
           ->first();
    }
}
