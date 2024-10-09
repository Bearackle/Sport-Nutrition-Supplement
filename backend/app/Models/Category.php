<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function product(){
        return $this->hasMany('Product','CategoryID','CategoryID');
    }
    public function parent(){
        return $this->belongsTo('Category','ParentID','CategoryID');
    }
    public function children(){
        return $this->hasMany('Category','ParentID','CategoryID');
    }  
}
