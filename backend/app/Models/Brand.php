<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Brand
 * @mixin Builder
 */
class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $fillable = ['BrandName'];
    protected $primaryKey = 'BrandID';
    public function product(){
        return $this->hasMany('Product','BrandID','BrandID');
    }
}
