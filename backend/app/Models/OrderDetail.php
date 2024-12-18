<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * OrderDetail
 * @mixin Builder
 */
class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = ['order_id','product_id','variant_id','combo_id','quantity','unit_price'];
    protected $primaryKey = 'order_detail_id';
    protected $table = 'order_details';
    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id','product_id');
    }
    public function variant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductVariant::class,'variant_id','variant_id');
    }
    public function combo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Combo::class,'combo_id','combo_id');
    }
}
