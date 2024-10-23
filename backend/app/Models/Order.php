<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Order
 * @mixin Builder
 */
class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = ['UserID','OrderDate','Note','Status','TotalAmount','AddressDetail','ShipmentCharges'];
    protected $primaryKey = 'OrderID';
    const CREATED_AT = 'OrderDate';
    const UPDATED_AT = null;
    public function payment(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Payment::class,'OrderID','OrderID');
    }
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class,'UserID','userid');
    }
    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class,'order_details','OrderID','ProductID');
    }
    public function variants(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(ProductVariant::class, 'order_details', 'OrderID', 'VariantID');
    }
    public function combos(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Combo::class,'order_details','OrderID','ComboID');
    }
}
