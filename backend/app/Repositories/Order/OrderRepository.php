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
        ->get();
    }
    public function getLatestOrder($userId){
        return Order::where('user_id',$userId)->
        OrderBy('order_date','desc')
        ->first();
    }
    public function getStatusOrder($orderId){
        return Order::select('order_id','status')
        ->where('order_id',$orderId)
        ->get();
    }
    public function getOrderByDateRange($range){
        return Order::whereBetween('order_date',[$range['start_date'],$range['end_date']])
        ->get();
    }
}