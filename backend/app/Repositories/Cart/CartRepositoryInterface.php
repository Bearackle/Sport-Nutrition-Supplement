<?php

namespace App\Repositories\Cart;

use App\Repositories\Interfaces\RepositoryInterface;

interface CartRepositoryInterface extends RepositoryInterface{
    public function getCartByUser($userId);
    public function getCartItems($cartId);
    public function getCartItemsForCartFix($cartId);
}
