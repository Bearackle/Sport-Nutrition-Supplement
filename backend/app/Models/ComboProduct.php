<?php

namespace App\Models;

use App\Traits\Scopes\ComboProductData;
use App\Traits\Scopes\ComboProductDataScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * ComboProduct
 * @mixin Builder
 */
class ComboProduct extends Model
{
    use HasFactory;
    protected $table = 'combo_products';
    protected $fillable = ['combo_id','product_id_fk','variant_id_fk','quantity'];
    protected $primaryKey = 'combo_product_id';
    public $timestamps = false;
//    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
//    {
//        return $this->belongsTo(Product::class,'product_id','product_id');
//    }
//    public function variant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
//    {
//        return $this->belongsTo(ProductVariant::class,'variant_id','variant_id');
//    }
//    public function combo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
//    {
//        return $this->belongsTo(Combo::class, 'combo_id', 'combo_id');
//    }
    protected static function booted(): void
    {
        static::addGlobalScope(ComboProductDataScope::class);
    }
}
