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
    protected $fillable = ['CategoryID', 'CategoryName','ParentID'];
    protected $primaryKey = 'CategoryID';
    protected $table = 'categories';
    public function product(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class,'CategoryID','CategoryID');
    }
    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class,'ParentID','CategoryID');
    }
    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Category::class,'ParentID','CategoryID');
    }
    public function combo(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Combo::class,'CategoryID','CategoryID');
    }
}
