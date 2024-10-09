<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    public function payment(){
        return $this->hasOne('Payment');
    }
    public function user(){
        return $this->belongsTo('User','UserID','OrderID');
    }
    public function products(){
        return $this->belongsToMany('Product','Orderdetails','OrderID','ProductID');
    }
    public function combos(){
        return $this->belongsToMany('Combo','OrderDetails','OrderID','ComboID');
    }
}
