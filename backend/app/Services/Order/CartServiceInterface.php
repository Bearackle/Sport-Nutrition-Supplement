<?php

namespace App\Services\Order;

use App\DTOs\InputData\CartItemInputData;
use App\DTOs\InputData\ShoppingCartInputData;

interface CartServiceInterface
{
    public function getCart(ShoppingCartInputData $cart);
    public function getItems($cart_id);
    public function createCart(ShoppingCartInputData $cart);
    public function addCartItem(CartItemInputData $cartItem);
    public function deleteCartItem(string $item_id);
    public function updateCartItemQuantity(string $id,array $cart_item);
    public function emptyCart($cart_id);
}
