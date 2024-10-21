<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

/**
 * CartItem
 * @mixin Builder
 */
class CartItem extends Model
{
    use HasFactory;
    protected $fillable = ['CartID','ProductID','VariantID','ComboID','Quantity'];
    protected $primaryKey = 'CartItemID';
    protected $table = 'cart_items';
    public $timestamps = false;
    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class,'ProductID','ProductID');
    }
    public function variant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductVariant::class,'VariantID','VariantID');
    }
    public function combo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Combo::class,'ComboID','ComboID');
    }
    public function cart(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ShoppingCart::class,'CartID','CartID');
    }
}
