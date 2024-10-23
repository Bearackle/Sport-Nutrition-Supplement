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
    public function getPaymentByOrderID($orderID): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\Payment)->where('OrderID',$orderID)
        ->get();
    }
    public function getPaymentByUserID($userID)
    {
        // TODO: Implement getPaymentByUserID() method.
    }
    public function getPaymentWithStatus(PaymentStatus $paymentStatus): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\Payment)->where('Status' ,$paymentStatus->value)
            ->orderBy('PaymentDate', 'DESC')
            ->get();
    }
}
