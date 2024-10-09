<?php

namespace App\Repositories\Payment;

use App\Models\Payment;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\RepositoryInterface;

class PaymentRepository extends BaseRepository implements RepositoryInterface{
    public function getModel(){
        return Payment::class;
    }
    public function getPaymentByOrderID($orderID){
        return Payment::where('OrderID',$orderID)
        ->get();
    }
    public function getPaymentByUserID($userID){
        return Payment::select('PaymentID','OrderID','PaymentMethod','PaymentStatus','PaymentDate')
        ->join('Orders','Orders.OrderID','Payments.OrderID')
        ->where('Orders.UserID',$usesrID)
        ->get();
    }
    public function getPendingPayment($userID){
        return Payment::select('PaymentID','OrderID','PaymentMethod','PaymentStatus','PaymentDate')
        ->join('Orders','Orders.OrderID','Payments.OrderID')
        ->where('Orders.UserID',$usesrID)
        ->where('Status','pending')
        ->get();
    }
}