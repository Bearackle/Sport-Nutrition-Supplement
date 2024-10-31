<?php

namespace App\Services\Order;

use App\DTOs\InputData\CartItemInputData;
use App\DTOs\OutputData\ShoppingCartOutputData;
use App\DTOs\OutputData\UserData\CartItemOutputData;
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
    public function getCart(\App\DTOs\InputData\ShoppingCartInputData $cart): ShoppingCartOutputData
    {
           $shoppingCart =  $this->cartRepository->getCartByUser($cart->user_id);
           return ShoppingCartOutputData::from($shoppingCart);
    }
    public function getItems($cart_id){
        return $this->cartRepository->getCartItems($cart_id)->with(['variants' => function ($query) {
                $query->with(['product'=> function ($product) {
                    $product->select("ProductID","ProductName","PriceAfterSale");
                },'image'])->select("product_variants.VariantID","VariantName");
            }, 'combos' => function ($combo) {
                $combo->select('combos.ComboID', 'ComboName', 'Cb_PriceAfterSale','Cb_ImageUrl');
       }])->get();
    }
    public function createCart(\App\DTOs\InputData\ShoppingCartInputData $cart): ShoppingCartOutputData
    {
        return ShoppingCartOutputData::from($this->cartRepository->create($cart->all()));
    }
    public function addCartItem(CartItemInputData $cartItem): CartItemOutputData
    {
        return CartItemOutputData::from($this->cartItemRepository->create($cartItem->all()));
    }
    public function deleteCartItem(string $item_id) : void
    {
        $this->cartItemRepository->delete($item_id);
    }
    public function updateCartItemQuantity(string $id,array $cart_item) : void
    {
        $data_to_update = ['Quantity' => $cart_item['Quantity']];
        $this->cartItemRepository->update($id,$data_to_update);
    }
    public function emptyCart($cart_id) : void
    {
        $this->cartItemRepository->emptyCart($cart_id);
    }
}
