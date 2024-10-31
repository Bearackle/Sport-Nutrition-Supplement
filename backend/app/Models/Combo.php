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
    protected $fillable = ['combo_name','description','price','combo_sale','combo_price_after_sale','combo_image_url','category_id'];
    protected $primaryKey = 'ComboID';
    protected $table = 'combos';
    public function orders(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Order::class,'order_details','combo_id','order_id');
    }
    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class,'combo_products','combo_id','product_id');
    }
    public function variants(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(ProductVariant::class,'combo_products','combo_id','variant_id');
    }
    public function carts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(ShoppingCart::class,'cart_items','combo_id','cart_id');
    }
    public function reviews(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Review::class,'combo_id','combo_id');
    }
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id','category_id');
    }
}
