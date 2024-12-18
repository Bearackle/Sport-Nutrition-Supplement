<?php

namespace App\Repositories\Order;

use App\Repositories\Interfaces\RepositoryInterface;

interface OrderRepositoryInterface extends RepositoryInterface{
    public function getAllOrdersByUserID($userId);
    public function getLatestOrder($userId);
    public function getStatusOrder($orderId);
    public function getOrderByDateRange($range);
    public function getAllOrders();
    public function getOrderWithProducts($orderId);
}
