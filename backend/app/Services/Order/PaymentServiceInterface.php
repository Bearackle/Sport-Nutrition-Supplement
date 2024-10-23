<?php

namespace App\Services\Order;

interface PaymentServiceInterface
{
    public function addPaymentMethod(array $data);
    public function getPayments();
    public function getPayment($order_id);
}
