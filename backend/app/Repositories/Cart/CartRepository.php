<?php

namespace App\Repositories\Cart;

use App\Models\ShoppingCart;
use App\Repositories\BaseRepository;
use App\Repositories\Cart\CartRepositoryInterface;

class CartRepository extends BaseRepository implements CartRepositoryInterface{
    public function getModel(): string
    {
        return ShoppingCart::class;
    }
    public function getCartIDByUser($userID): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\ShoppingCart)->select('CartID')
        ->where('UserID')
        ->get();
    }
    public function getCartItems($cart_id)
    {
        return (new \App\Models\ShoppingCart)->with('products','variants','combos')
            ->find($cart_id);
    }
}
