<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Combo extends Model
{
    use HasFactory;
    public function orders(){
        return $this->belongsToMany('Order','OrderDetails','ComboID','OrderID');
    }
    public function products(){
        return $this->belongsToMany('Product','ComboProducts','ComboID','ProductID');
    }
    public function productvariants(){
        return $this->belongsToMany('ProductVariant','ComboProducts','ComboID','VariantID');
    }
    public function carts(){
        return $this->belongsToMany('ShoppingCart','CartItems','ComboID','CartID');
    }
    public function reviews(){
        return $this->hasMany('Review','ComboID','ComboID');
    }
}
