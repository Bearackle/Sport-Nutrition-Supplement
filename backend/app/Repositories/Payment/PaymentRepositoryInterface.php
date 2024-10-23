<?php

namespace App\Repositories\Payment;

use App\Enum\PaymentStatus;
use App\Repositories\Interfaces\RepositoryInterface;

interface PaymentRepositoryInterface extends RepositoryInterface{
    public function getPaymentByOrderID($orderID);
    public function getPaymentByUserID($userID);
    public function getPaymentWithStatus(PaymentStatus $paymentStatus);
}
