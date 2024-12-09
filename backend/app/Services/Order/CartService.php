<?php

namespace App\Services\Order;

use App\DTOs\InputData\CartItemInputData;
use App\DTOs\InputData\ShoppingCartInputData;
use App\DTOs\InputData\UserInputData;
use App\DTOs\OutputData\CartItemOutputData;
use App\DTOs\OutputData\ShoppingCartOutputData;
use App\Models\ShoppingCart;
use App\Repositories\Cart\CartItemRepositoryInterface;
use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
class CartService implements CartServiceInterface
{

    protected CartRepositoryInterface $cartRepository;
    protected CartItemRepositoryInterface $cartItemRepository;
    protected UserRepositoryInterface $userRepository;
    public function __construct(CartRepositoryInterface $cartRepository,
                                CartItemRepositoryInterface $cartItemRepository, UserRepositoryInterface $userRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->cartItemRepository = $cartItemRepository;
        $this->userRepository = $userRepository;
    }
    public function getCart(UserInputData $user): ShoppingCartOutputData
    {
           $shoppingCart =  $this->cartRepository->getCartByUser($user->user_id);
           if($shoppingCart == null){
              return $this->createCart(ShoppingCartInputData::validateAndCreate(['user_id' => $user->user_id]));
           }
           return ShoppingCartOutputData::from($shoppingCart);
    }
    public function getItems(ShoppingCartInputData $cart){
        return $this->cartRepository->getCartItems($cart->cart_id);
    }
    public function createCart(\App\DTOs\InputData\ShoppingCartInputData $cart): ShoppingCartOutputData
    {
        return ShoppingCartOutputData::from($this->cartRepository->create($cart->all()));
    }
    public function addCartItem(CartItemInputData $cartItem): CartItemOutputData
    {
        return CartItemOutputData::from($this->cartItemRepository->create($cartItem->all()));
    }
    public function deleteCartItem(CartItemInputData $cartItem) : void
    {
        $this->cartItemRepository->delete($cartItem->cart_item_id);
    }
    public function updateCartItemQuantity(CartItemInputData $cartItem): CartItemOutputData | bool
    {
        $cartItemUpdated = $this->cartItemRepository->update($cartItem->cart_item_id,['quantity' => $cartItem->quantity]);
        if(!$cartItemUpdated){
            return false;
        }
        return CartItemOutputData::from($cartItemUpdated);
    }
    public function emptyCart(ShoppingCartInputData $cart) : void
    {
        $this->cartItemRepository->emptyCart($cart->cart_id);
    }
}