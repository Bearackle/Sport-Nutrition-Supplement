<?php

namespace App\Repositories\Order;

use App\Repositories\Interfaces\RepositoryInterface;

interface OrderDetailRepositoryInterface extends RepositoryInterface {
    public function TotalOrderDetailCost($orderID);
    public function getAllInsideOrder($orderID);
    public function getAllProducts($orderID);
    public function getAllCombos($orderID);
}
