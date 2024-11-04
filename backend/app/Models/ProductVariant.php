<?php

namespace App\Models;

use App\Models\ImageLinkModels\ProductImages;
use App\Observers\ProductStockQuantityObserver;
use App\Traits\ProductStockChecking;
use App\Traits\Scopes\VariantDataScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * ProductVariant
 * @mixin Builder
 */
class ProductVariant extends Model
{
    use HasFactory;
    protected $table = 'product_variants';
    protected $fillable = ['product_id','variant_name','stock_quantity'];
    protected $primaryKey = 'variant_id';
    public $timestamps = false;
    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id','product_id');
    }
    public function combos(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Combo::class,'combo_products','variant_id','combo_id');
    }
    public function carts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(ShoppingCart::class,'cart_items','variant_id','cart_id');
    }
    public function image(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProductImages::class,'variant_id','variant_id');
    }
    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_details','variant_id','order_id');
    }
    protected static function booted() : void
    {
        static::addGlobalScope(new VariantDataScope);
    }
}
