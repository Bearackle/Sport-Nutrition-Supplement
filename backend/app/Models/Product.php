<?php

namespace App\Models;

use App\Models\ImageLinkModels\ProductImages;
use App\Models\ImageLinkModels\RatingImages;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Product
 * @mixin Builder
 */
class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'ProductID';
    protected $fillable = ['ProductName','Short_Description','Description','Price','Sale',
        'StockQuantity','CategoryID','BrandID','PriceAfterSale'];
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class,'CategoryID','CategoryID');
    }
    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Brand::class,'BrandID','BrandID');
    }
    public function variations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductVariant::class,'ProductID','ProductID');
    }
    public function orders(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Order::class,'Order_Details','ProductID','OrderID');
    }
    public function carts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(ShoppingCart::class,'Cart_Items','ProductID','CartID');
    }
    public function combos(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Combo::class,'Combo_Products','ProductID','ComboID');
    }
    public function reviews(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Review::class,'ProductID','ProductID');
    }
    public function images(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductImages::class,'ProductID','ProductID');
    }
    public function ratings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RatingImages::class,'ProductID','ProductID');
    }
}
