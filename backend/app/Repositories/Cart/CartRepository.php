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
    public function getCartByUser($userId) : ShoppingCart | null
    {
        return (new \App\Models\ShoppingCart)
        ->where('user_id',$userId)->first();
    }
    public function getCartItems($cartId)
    {
        return ShoppingCart::with(['variants' => function ($variant) {
            $variant->with(['product','image']);
            }]
            ,'combos')->find($cartId);
    }
    public function getCartItemsForCartFix($cartId)
    {
        return ShoppingCart::with(['variants' => function ($variant) {
                $variant->with(['product' => function($product){
                    $product->with(['images']);
                },'image']);
            }]
            ,'combos')->find($cartId);
    }
}
