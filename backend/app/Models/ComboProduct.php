<?php

namespace App\Models;

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
    protected $fillable = ['ComboID','ProductID','VariantID','Quantity'];
    protected $primaryKey = 'ComboProductID';
    public function product(){
        return $this->belongsTo(Product::class,'ProductID','ProductID');
    }
    public function variant(){
        return $this->belongsTo(ProductVariant::class,'VariantID','VariantID');
    }
    public function combo()
    {
        return $this->belongsTo(Combo::class, 'ComboID', 'ComboID');
    }
}
