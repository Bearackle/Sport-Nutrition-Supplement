<?php

namespace App\Services\Order;

use App\Models\Order;

interface OrderServiceInterface
{

    public function getOrderData($order_id);
    public function createOrder(array $data);
    public function addProductToOrder(Order $order, array $data);
    public function updateProductQuantityOrder(Order $order, array $data);
    public function deleteProductFromOrder(Order $order, array $data);
    public function destroyOrder($id);
}
