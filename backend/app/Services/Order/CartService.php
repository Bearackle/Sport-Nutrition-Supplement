<?php

namespace App\Services\Order;

use App\Repositories\Cart\CartItemRepositoryInterface;
use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\User\UserServiceInterface;

class CartService implements CartServiceInterface
{

    protected CartRepositoryInterface $cartRepository;
    protected CartItemRepositoryInterface $cartItemRepository;
    protected UserRepositoryInterface $user_repository;
    public function __construct(CartRepositoryInterface $cartRepository,
                                CartItemRepositoryInterface $cartItemRepository, UserRepositoryInterface $user_repository)
    {
        $this->cartRepository = $cartRepository;
        $this->cartItemRepository = $cartItemRepository;
        $this->user_repository = $user_repository;
    }
    public function getCart($user_id)
    {
           $shopping_cart =  $this->user_repository->find($user_id)->load('shopping_cart');
           return $shopping_cart->shopping_cart;
    }
    public function getItems($cart_id){
        return $this->cartRepository->find($cart_id)->load(['products'
        => function($query){
            $query->select('products.ProductID','ProductName','PriceAfterSale')
                ->with(['images' => function($query){
                    $query->where('IsPrimary', true)
                    ->where('VariantID',null);
                }])->withPivot('Quantity');
            },
            'variants' => function ($query) {
                $query->select('product_variants.VariantID','product_variants.ProductID','VariantName')
                ->withPivot('Quantity');
        },
            'combos' => function ($query) {
                $query->select('combos.ComboID', 'ComboName', 'Cb_PriceAfterSale','Cb_ImageUrl')
                ->withPivot('Quantity');
        }]);
    }
    public function createCart($user_id)
    {
        $data['UserID'] = $user_id;
        return $this->cartRepository->create($data);
    }
    public function addCartItem(array $data)
    {
        return $this->cartItemRepository->create($data);
    }
    public function deleteCartItem(array $data) : void
    {
        $this->cartItemRepository->delete($data['id']);
    }
    public function updateCartItemQuantity(array $cart_item) : void
    {
        $data_to_update = ['Quantity' => $cart_item['Quantity']];
        $this->cartItemRepository->update($cart_item['id'],$data_to_update);
    }
    public function emptyCart($cart_id) : void
    {
        $this->cartItemRepository->emptyCart($cart_id);
    }
}
