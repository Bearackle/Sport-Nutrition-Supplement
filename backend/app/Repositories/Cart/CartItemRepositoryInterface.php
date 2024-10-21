<?php

namespace App\Repositories\Cart;

use App\Repositories\Interfaces\RepositoryInterface;

interface CartItemRepositoryInterface extends RepositoryInterface{
    public function getAllInsideCart($cartID);
    public function getProductByCartID($cartID);
    public function getComboByCartID($cartID);
    public function emptyCart($cart_id);
}
