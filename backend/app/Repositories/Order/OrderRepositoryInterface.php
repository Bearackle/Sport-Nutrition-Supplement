<?php

namespace App\Repositories\Order;

use App\Repositories\Interfaces\RepositoryInterface;

interface OrderRepositoryInterface extends RepositoryInterface{
    public function getAllOrdersByUserID($userID);
    public function getLatestOrder($userID);
    public function getStatusOrder($orderID);
    public function getOrderByDateRange($range);
}
