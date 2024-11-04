<?php

namespace App\Services\Order;

use App\DTOs\InputData\OrderInputData;
use App\DTOs\InputData\PaymentInputData;

interface PaymentServiceInterface
{
    public function addPaymentMethod(PaymentInputData $payment);
    public function getPayments();
    public function getPayment(OrderInputData $order);
}
