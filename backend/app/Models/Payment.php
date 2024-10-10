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
    protected $fillable = ['OrderID','PaymentMethod','PaymentStatus','PaymentDate'];
    protected $primaryKey = 'PaymentID';
    protected $table = 'payments';
    public function order(){
        return $this->belongsTo('Order');
    }
}
