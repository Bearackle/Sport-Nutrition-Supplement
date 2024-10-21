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
    public $timestamps = false;
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
        return $this->belongsTo(Combo::class, 'ComboID', 'ComboID');
    }
}
