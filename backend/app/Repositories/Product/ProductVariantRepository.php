<?php

namespace App\Repositories\Product;

use App\Models\ProductVariant;
use App\Repositories\BaseRepository;

class ProductVariantRepository extends BaseRepository implements ProductVariantRepositoryInterface
{
    public function getModel(){
        return ProductVariant::class;
    }
    public function getVariantAvailableForProduct($productID){
        return ProductVariant::where('ProductID',$productID);
    }
    public function findVariantByNameAndProduct($variantName,$productID){
        return ProductVariant::where('ProductID',$productID)
        ->where('VariantName',$variantName)
        ->get();
    }
}
