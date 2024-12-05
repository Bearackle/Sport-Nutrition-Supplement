<?php

namespace App\Services\Order;

use App\DTOs\InputData\OrderInputData;
use App\DTOs\InputData\PaymentInputData;
use App\DTOs\OutputData\OrderOutputData;
use http\Env\Request;

interface PaymentServiceInterface
{
    public function addPaymentMethod(PaymentInputData $payment);
    public function getPayments();
    public function getPaymentData(OrderInputData $order);
    public function createPayment(OrderInputData $order);
}
