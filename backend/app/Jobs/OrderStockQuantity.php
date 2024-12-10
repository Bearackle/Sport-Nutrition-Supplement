<?php

namespace App\Jobs;

use App\Enum\OrderStatus;
use App\Models\Order;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Traits\ProductStockChecking;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class OrderStockQuantity implements ShouldQueue
{
    use Queueable;
    use ProductStockChecking;
    public array $data;
    public Order $order;
    public OrderRepositoryInterface $orderRepository;
    /**
     * Create a new job instance.
     * @throws BindingResolutionException
     */
    public function __construct($data,$order, OrderRepositoryInterface $orderRepository)
    {
        $this->data = $data;
        $this->order = $order;
        $this->orderRepository = $orderRepository;
        $this->setDependency();
    }
    /**
     * Execute the job.
     * @throws \Exception
     */
    public function handle(): void
    {
        $orderUpdated = $this->orderRepository->find($this->order->order_id);
        if(OrderStatus::tryFrom($orderUpdated->status)->is(OrderStatus::SHIPPED)){
            return;
        }
        $orderUpdated->update(['status' => OrderStatus::CANCELLED->value]);
        $this->returnQuantity($this->data);
    }
}
