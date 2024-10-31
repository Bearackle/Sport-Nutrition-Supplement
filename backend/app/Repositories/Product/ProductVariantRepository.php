<?php

namespace App\Repositories\Product;

use App\Models\ProductVariant;
use App\Repositories\BaseRepository;

class ProductVariantRepository extends BaseRepository implements ProductVariantRepositoryInterface
{
    public function getModel(): string
    {
        return ProductVariant::class;
    }
    public function getVariantAvailableForProduct($productId): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\ProductVariant)->where('product_id',$productId)
            ->where('stock_quantity', '>','0')
            ->get();
    }
    public function findVariantByNameAndProduct($variantName,$productId): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\ProductVariant)->where('product_id',$productId)
        ->where('variant_name',$variantName)
        ->get();
    }
    public function getImageProductVariant($productVariantsId){
        return (new \App\Models\ProductVariant)->find($productVariantsId)->image;
    }
    public function getVariantsDataWithImage($productId): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\ProductVariant)->where('product_id',$productId)
            ->with(['image' =>function($query){
        $query->whereNotNull('variant_id');}])
            ->get();
    }
    public function increaseStock($productVariantID,$stockQuantity) : void {
        (new \App\Models\ProductVariant)->where('variant_id', $productVariantID)
            ->increment('stock_quantity',$stockQuantity);
    }
    public function decreaseStock($productVariantId,$stockQuantity) : void {
        (new \App\Models\ProductVariant)->where('variant_id' ,$productVariantId)
            ->decrement('stock_quantity',$stockQuantity);
    }
}
