<?php

namespace App\Repositories\Order;

use App\Repositories\Interfaces\RepositoryInterface;

interface OrderDetailRepositoryInterface extends RepositoryInterface {
    public function TotalOrderDetailCost($orderId);
    public function getAllInsideOrder($orderId);
    public function getAllProducts($orderId);
    public function getAllCombos($orderId);
}
