<?php

namespace App\Repositories\Cart;

use App\Models\ShoppingCart;
use App\Repositories\BaseRepository;
use App\Repositories\Cart\CartRepositoryInterface;

class CartRepository extends BaseRepository implements CartRepositoryInterface{
    public function getModel(){
        return ShoppingCart::class;
    }
    public function getCartIDByUser($userID){
        return ShoppingCart::select('CartID')
        ->where('UserID')
        ->get();
    }
}