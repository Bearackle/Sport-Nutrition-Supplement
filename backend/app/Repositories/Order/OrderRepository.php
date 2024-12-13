<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Repositories\BaseRepository;
use App\Repositories\Order\OrderRepositoryInterface;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function getModel(): string
    {
        return Order::class;
    }
    public function getAllOrdersByUserID($userId): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\Order)->where('user_id',$userId)->
        OrderBy('order_date','desc')
            ->with(['variants' => function ($variant) {
                $variant->with(['product','image']);
            }])->get();
    }
    public function getLatestOrder($userId)
    {
        return (new \App\Models\Order)->where('user_id',$userId)->
        orderBy('order_date','desc')
            ->first();
    }
    public function getStatusOrder($orderId): \Illuminate\Database\Eloquent\Collection
    {
        return Order::select('order_id','status')
        ->where('order_id',$orderId)
        ->get();
    }
    public function getOrderByDateRange($range){
        return Order::whereBetween('order_date',[$range['start_date'],$range['end_date']])
        ->get();
    }
    public function getOrderWithProducts($orderId)
    {
        return Order::with(['variants' => function ($variant) {
                $variant->with(['product','image']);
            }])->find($orderId);
    }    public function getAllOrders()
    {
       return (new \App\Models\Order)->orderBy('order_date','desc');
    }
}
