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
    public function getCartByUser($userId) : ShoppingCart
    {
        return (new \App\Models\ShoppingCart)
        ->where('user_id',$userId)->first();
    }
    public function getCartItems($cartId)
    {
        return (new \App\Models\ShoppingCart)->with('variants','combos')
            ->find($cartId);
    }
}
