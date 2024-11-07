<?php

namespace App\Repositories\Payment;

use App\Enum\PaymentStatus;
use App\Models\Payment;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\RepositoryInterface;

class PaymentRepository extends BaseRepository implements PaymentRepositoryInterface {
    public function getModel(){
        return Payment::class;
    }
    public function getPaymentByOrderID($orderId)
    {
        return (new \App\Models\Payment)->where('order_id',$orderId)
        ->first();
    }
    public function getPaymentByUserID($userId)
    {
        // TODO: Implement getPaymentByUserID() method.
    }
    public function getPaymentWithStatus(PaymentStatus $paymentStatus): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\Payment)->where('status' ,$paymentStatus->value)
            ->orderBy('payment_date', 'DESC')
            ->get();
    }
}
