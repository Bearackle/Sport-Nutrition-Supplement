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
    protected $fillable = ['brand_name'];
    protected $primaryKey = 'brand_id';
    public $timestamps = false;
    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('products','brand_id','brand_id');
    }
}
