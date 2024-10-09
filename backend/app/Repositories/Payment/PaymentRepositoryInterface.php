<?php

namespace App\Repositories\Payment;

use App\Repositories\Interfaces\RepositoryInterface;

interface PaymentRepositoryInterface extends RepositoryInterface{
    public function getPaymentByOrderID($orderID);
    public function getPaymentByUserID($userID);
    public function getPendingPayment($userID);
}