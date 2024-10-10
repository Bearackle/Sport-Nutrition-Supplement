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
    protected $table = 'order_detail';
    public function product(){
        return $this->belongsTo(Product::class,'ProductID','ProductID');
    }
    public function variant(){
        return $this->belongsTo(ProductVariant::class,'VariantID','VariantID');
    }
    public function combo(){
        return $this->belongsTo(Combo::class,'ComboID','ComboID');
    }
}
