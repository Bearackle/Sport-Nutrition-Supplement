<?php

namespace App\Listeners;

use App\Events\addShippingCharges;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Services\Order\OrderServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class updateTotalAmount
{
    protected OrderRepositoryInterface $order_repository;
    /**
     * Create the event listener.
     */
    public function __construct(OrderRepositoryInterface $order_repository)
    {
        $this->order_repository = $order_repository;
    }

    /**
     * Handle the event.
     */
    public function handle(addShippingCharges $event): void
    {
        $this->order_repository->find($event->order->OrderID)->
            increment('TotalAmount',$event->method->value);
    }
}
