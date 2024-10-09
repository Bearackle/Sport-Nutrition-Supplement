<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo('User','userid','userid');
    }
    public function products(){
        return $this->belongsToMany('Product','CartItems','CartID','ProductID');
    }
    public function productVariants(){
        return $this->belongsToMany('ProductVariant','CartItems','CartID','VariantID'); 
    }
}
