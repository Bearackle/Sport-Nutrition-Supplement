<?php

namespace App\Repositories\Payment;

use App\Enum\PaymentStatus;
use App\Repositories\Interfaces\RepositoryInterface;

interface PaymentRepositoryInterface extends RepositoryInterface{
    public function getPaymentByOrderID($orderId);
    public function getPaymentByUserID($userId);
    public function getPaymentWithStatus(PaymentStatus $paymentStatus);
}
