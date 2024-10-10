<?php

namespace App\Repositories\Product;

use App\Models\ProductVariant;
use App\Repositories\BaseRepository;

class ProductVariantRepository extends BaseRepository implements ProductVariantRepositoryInterface
{
    public function getModel(){
        return ProductVariant::class;
    }
    public function getVariantAvailableForProduct($productID): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\ProductVariant)->where('ProductID',$productID)
            ->where('StockQuantity', '>','0')
            ->get();
    }
    public function findVariantByNameAndProduct($variantName,$productID): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\ProductVariant)->where('ProductID',$productID)
        ->where('VariantName',$variantName)
        ->get();
    }
    public function getImageProductVariant($productVariantsID){
        return $this->find($productVariantsID)->image;
    }
    public function getVariantsDataWithImage($productID): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\ProductVariant)->where('ProductID', $productID)
            ->with('image')
            ->get();
    }
}
