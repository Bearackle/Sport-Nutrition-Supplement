<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Payment
 * @mixin Builder
 */
class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['order_id','payment_method','payment_status'];
    protected $primaryKey = 'payment_id';
    protected $table = 'payments';
    const CREATED_AT = 'payment_date';
    const UPDATED_AT = null;
    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id','order_id');
    }
}
