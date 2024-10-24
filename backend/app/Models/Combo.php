<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Combo
 * @mixin Builder
 */
class Combo extends Model
{
    use HasFactory;
    protected $fillable = ['ComboName','Description','Price','Cb_Sale','Cb_PriceAfterSale','Cb_ImageURL','CategoryID'];
    protected $primaryKey = 'ComboID';
    protected $table = 'combos';
    public function orders(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Order::class,'OrderDetails','ComboID','OrderID');
    }
    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class,'combo_products','ComboID','ProductID');
    }
    public function variants(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(ProductVariant::class,'combo_products','ComboID','VariantID');
    }
    public function carts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(ShoppingCart::class,'CartItems','ComboID','CartID');
    }
    public function reviews(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Review::class,'ComboID','ComboID');
    }
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class,'CategoryID','CategoryID');
    }
}
