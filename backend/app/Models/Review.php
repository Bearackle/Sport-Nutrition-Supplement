<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Review
 * @mixin Builder
 */
class Review extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo('User','UserID','UserID');
    }
    public function Combo(){
        return $this->belongsTo('Combo','ComboID','ComboID');
    }
    public function Product(){
        return $this->belongsToMany('Product','ProductID','ProductID');
    }
}
