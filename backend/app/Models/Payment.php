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
    protected $fillable = ['OrderID','PaymentMethod','PaymentStatus'];
    protected $primaryKey = 'PaymentID';
    protected $table = 'payments';
    const CREATED_AT = 'PaymentDate';
    const UPDATED_AT = null;
    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Order::class, 'OrderID','OrderID');
    }
}
