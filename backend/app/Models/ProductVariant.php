<?php

namespace App\Models;

use App\Models\ImageLinkModels\ProductImages;
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
    protected $fillable = ['ProductID','VariantName','StockQuantity'];
    protected $primaryKey = 'VariantID';
    public $timestamps = false;
    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('Product','ProductID','ProductID');
    }
    public function combos(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany('Combo','ComboProducts','VariantID','ComboID');
    }
    public function carts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany('ShoppingCart','CartItems','VariantID','CartID');
    }
    public function image(){
        return $this->hasOne(ProductImages::class,'VariantID','VariantID');
    }
}
