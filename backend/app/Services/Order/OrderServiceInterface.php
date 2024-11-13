<?php

namespace App\Services\Order;

use App\DTOs\InputData\AddressInputData;
use App\DTOs\InputData\OrderInputData;
use App\DTOs\InputData\PaymentInputData;
use App\DTOs\InputData\ShippingMethodInputData;
use App\DTOs\InputData\UserInputData;
use App\Enum\OrderStatus;
use App\Models\Order;
use App\Models\Payment;

interface OrderServiceInterface
{
    public function getOrderData(OrderInputData $order);
    public function getAllOrders();
    public function getOrderofUser(UserInputData $user);
    public function createOrder(UserInputData $user, string $message);
    public function updateOrder(OrderInputData $order);
    public function destroyOrder(OrderInputData $order);
    public function addAddress(OrderInputData $order, AddressInputData $address);
    public function addPaymentMethod(PaymentInputData $payment);
    public function addShippingMethod(OrderInputData $order, ShippingMethodInputData $ship);
}
