<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function category(){
        return $this->belongsTo('Category','CategoryID','CategoryID');
    }
    public function brand(){
        return $this->belongsTo('Brand','BrandID','BrandID');
    }
    public function productVariant(){
        return $this->hasMany('ProductVariant','ProductID','ProductID');
    }
    public function orders(){
        return $this->belongsToMany('Order','OrderDetails','ProductID','OrderID');
    }
    public function carts(){
        return $this->belongsToMany('ShoppingCart','CartItems','ProductID','CartID');
    }
    public function combos(){
        return $this->belongsToMany('Combo','ComboProducts','ProductID','ComboID');
    }
    public function reviews(){
        return $this->hasMany('Review','ProductID','ProductID');
    }
}
