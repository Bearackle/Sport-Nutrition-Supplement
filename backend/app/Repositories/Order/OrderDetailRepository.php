<?php

namespace App\Repositories\Order;

use App\Models\OrderDetail;
use App\Repositories\BaseRepository;
use App\Repositories\Order\OrderDetailRepositoryInterface;

class OrderDetailRepository extends BaseRepository implements OrderDetailRepositoryInterface{
    public function getModel(){
        return OrderDetail::class;
    }
    public function getAllInsideOrder($orderID){
        return OrderDetail::select('OrderDetailID')
        ->where('OrderID',$orderID)
        ->get();
    }
    public function getAllProducts($orderID){
        return OrderDetail::select('ProductID','VariantID','Quantity','UnitPrice')
        ->where('OrderID',$orderID)
        ->whereNotNull('ProductID')
        ->get();
    }
    public function getAllCombos($orderID){
        return OrderDetail::select('ComboID','Quantity','UnitPrice')
        ->where('OrderID',$orderID)
        ->get();
    }
    public function TotalOrderDetailCost($orderID){
        return OrderDetail::selectRaw('SUM( Quantity * UnitPrice ) as total')
        ->first();
    }
}