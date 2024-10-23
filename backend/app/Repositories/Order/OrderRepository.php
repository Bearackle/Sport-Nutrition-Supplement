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
    public function getAllOrdersByUserID($userID): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\Order)->where('UserID',$userID)->
        OrderBy('OrderDate','desc')
        ->get();
    }
    public function getLatestOrder($userID){
        return Order::where('UserID',$userID)->
        OrderBy('OrderDate','desc')
        ->first();
    }
    public function getStatusOrder($orderID){
        return Order::select('OrderID','Status')
        ->where('orderID',$orderID)
        ->get();
    }
    public function getOrderByDateRange($range){
        return Order::whereBetween('OrderDate',[$range['start_date'],$range['end_date']])
        ->get();
    }
}
