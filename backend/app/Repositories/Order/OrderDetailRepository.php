<?php

namespace App\Repositories\Order;

use App\Models\OrderDetail;
use App\Repositories\BaseRepository;
use App\Repositories\Order\OrderDetailRepositoryInterface;

class OrderDetailRepository extends BaseRepository implements OrderDetailRepositoryInterface{
    public function getModel(){
        return OrderDetail::class;
    }
    public function getAllInsideOrder($orderId): \Illuminate\Database\Eloquent\Collection
    {
        return OrderDetail::select('order_detail_id')
        ->where('order_id',$orderId)
        ->get();
    }
    public function getAllProducts($orderId): \Illuminate\Database\Eloquent\Collection
    {
        return OrderDetail::select('product_id','variant_id','quantity','unit_price')
        ->where('order_id',$orderId)
        ->whereNotNull('product_id')
        ->get();
    }
    public function getAllCombos($orderId): \Illuminate\Database\Eloquent\Collection
    {
        return OrderDetail::select('combo_id','quantity','unit_price')
        ->where('order_id',$orderId)
        ->get();
    }
    public function TotalOrderDetailCost($orderId){
        return OrderDetail::selectRaw('SUM( quantity * unit_price ) as total')
        ->first();
    }
}
