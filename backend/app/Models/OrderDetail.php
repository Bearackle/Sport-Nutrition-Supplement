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
    protected $fillable = ['OrderID','ProductID','VariantID','ComboID','Quantity','UnitPrice'];
    protected $primaryKey = 'OrderDetailID';
    protected $table = 'order_details';
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
}
