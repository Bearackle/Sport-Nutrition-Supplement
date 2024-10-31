<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * ShoppingCart
 * @mixin Builder
 */
class ShoppingCart extends Model
{
    use HasFactory;
    protected  $table = 'shopping_carts';
    protected $fillable = ['user_id'];
    protected $primaryKey = 'cart_id';
    const UPDATED_AT = null;
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','user_id');
    }
    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class,'cart_items','cart_id','product_id')
            ->withPivot('quantity');
    }
    public function variants(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(ProductVariant::class,'cart_items','cart_id','variant_id')
            ->withPivot('quantity');
    }
    public function combos(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Combo::class,'cart_items','cart_id','combo_id')
            ->withPivot('quantity');
    }
}
