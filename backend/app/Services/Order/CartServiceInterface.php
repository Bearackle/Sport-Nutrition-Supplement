<?php

namespace App\Services\Order;

use App\DTOs\InputData\CartItemInputData;
use App\DTOs\InputData\ShoppingCartInputData;
use App\DTOs\InputData\UserInputData;

interface CartServiceInterface
{
    public function getCart(UserInputData $user);
    public function getItems(ShoppingCartInputData $cart);
    public function createCart(ShoppingCartInputData $cart);
    public function addCartItem(CartItemInputData $cartItem);
    public function deleteCartItem(CartItemInputData $cartItem);
    public function updateCartItemQuantity(CartItemInputData $cartItem);
    public function emptyCart(ShoppingCartInputData $cart);
    public function updateCartItemsVersion(ShoppingCartInputData $cart);
    public function checkCartItemsVersion(ShoppingCartInputData $cart);
}
