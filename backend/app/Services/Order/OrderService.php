<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Repositories\Order\OrderDetailRepositoryInterface;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\OrderRepositoryInterface;

class OrderService implements OrderServiceInterface
{
    protected OrderRepositoryInterface $order_repository;
    protected OrderDetailRepositoryInterface $order_detail_repository;
    public function __construct(OrderRepositoryInterface $order_repository,
                                OrderDetailRepositoryInterface $order_detail_repository)
    {
        $this->order_repository = $order_repository;
        $this->order_detail_repository = $order_detail_repository;
    }
    public function getOrderData($order_id)
    {
        return $this->order_repository->find($order_id);
    }
    public function createOrder(array $data)
    {

    }

    public function addProductToOrder(Order $order, array $data)
    {
        // TODO: Implement addProductToOrder() method.
    }

    public function updateProductQuantityOrder(Order $order, array $data)
    {
        // TODO: Implement updateProductQuantityOrder() method.
    }

    public function deleteProductFromOrder(Order $order, array $data)
    {
        // TODO: Implement deleteProductFromOrder() method.
    }

    public function destroyOrder($id)
    {
        // TODO: Implement destroyOrder() method.
    }
}
