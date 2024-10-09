<?php

namespace App\Repositories\Order;

interface OrderDetailRepositoryInterface extends RepositoryInterface{
    public function TotalOrderDetailCost($orderID);   
    public function getAllInsideOrder($orderID);
    public function getAllProducts($orderID);
    public function getAllCombos($orderID);
}