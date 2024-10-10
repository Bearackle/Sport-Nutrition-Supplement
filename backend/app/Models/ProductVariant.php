<?php

namespace App\Models;

use App\Models\ImageLinkModels\ProductImages;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * ProductVariant
 * @mixin Builder
 */
class ProductVariant extends Model
{
    use HasFactory;
    public function product(){
        return $this->belongsTo('Product','ProductID','ProductID');
    }
    public function combos(){
        return $this->belongsToMany('Combo','ComboProducts','VariantID','ComboID');
    }
    public function carts(){
        return $this->belongsToMany('ShoppingCart','CartItems','VariantID','CartID');
    }
    public function image(){
        return $this->hasOne(ProductImages::class,'VariantID','VariantID');
    }
}
