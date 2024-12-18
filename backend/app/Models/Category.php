<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Category
 * @mixin Builder
 */
class Category extends Model
{
    use HasFactory;
    protected $fillable = ['category_name','parent_id'];
    protected $primaryKey = 'category_id';
    protected $table = 'categories';
    public $timestamps = false;
    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class,'category_id','category_id');
    }
    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class,'parent_id','category_id');
    }
    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Category::class,'parent_id','category_id');
    }
    public function combos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Combo::class,'category_id','category_id');
    }
}
