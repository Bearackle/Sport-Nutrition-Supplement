<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
