<?php

namespace App\Repositories\Cart;

use App\Repositories\Interfaces\RepositoryInterface;

interface CartItemRepositoryInterface extends RepositoryInterface{
    public function getAllInsideCart($cartId);
    public function getProductByCartID($cartId);
    public function getComboByCartID($cartId);
    public function emptyCart($cartId);
    public function upadateVersion($cartId, $variantId,$version);
}
