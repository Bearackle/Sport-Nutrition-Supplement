<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Table;

/**
 * ShoppingCart
 * @mixin Builder
 */
class ShoppingCart extends Model
{
    use HasFactory;
    protected  $table = 'shopping_carts';
    protected $fillable = ['UserID'];
    protected $primaryKey = 'CartID';
    const UPDATED_AT = null;
    const CREATED_AT = 'CreatedAt';
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class,'userid','userid');
    }
    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class,'cart_items','CartID','ProductID')
            ->withPivot('Quantity');
    }
    public function variants(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(ProductVariant::class,'cart_items','CartID','VariantID')
            ->withPivot('Quantity');
    }
    public function combos(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Combo::class,'cart_items','CartID','ComboID')
            ->withPivot('Quantity');
    }
}
