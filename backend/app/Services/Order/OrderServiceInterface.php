<?php

namespace App\Services\Order;

use App\Enum\OrderStatus;
use App\Models\Order;

interface OrderServiceInterface
{
    public function getOrderData($order_id);
    public function createOrder($userid, string $message);
    public function updateOrderStatus($order_id, string $status);
    public function destroyOrder($id);
}
