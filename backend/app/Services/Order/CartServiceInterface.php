<?php

namespace App\Services\Order;

interface CartServiceInterface
{
    public function getCart($user_id);
    public function getItems($cart_id);
    public function createCart($user_id);
    public function addCartItem(array $data);
    public function deleteCartItem(array $data);
    public function updateCartItemQuantity(array $cart_item);
    public function emptyCart($cart_id);
}
