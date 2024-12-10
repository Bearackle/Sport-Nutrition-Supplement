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
    protected $fillable = ['cart_id','product_id_fk','variant_id_fk','combo_id_fk','quantity','version'];
    protected $primaryKey = 'cart_item_id';
    protected $table = 'cart_items';
    public $timestamps = false;
//    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
//    {
//        return $this->belongsTo(Product::class,'product_id_fk','product_id');
//    }
//    public function variant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
//    {
//        return $this->belongsTo(ProductVariant::class,'variant_id_fk','variant_id');
//    }
//    public function combo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
//    {
//        return $this->belongsTo(Combo::class,'combo_id_fk','combo_id');
//    }
//    public function cart(): \Illuminate\Database\Eloquent\Relations\BelongsTo
//    {
//        return $this->belongsTo(ShoppingCart::class,'cart_id','cart_id');
//    }
}
