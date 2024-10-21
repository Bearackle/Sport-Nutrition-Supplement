<?php

namespace App\Repositories\Cart;

use App\Models\CartItem;
use App\Repositories\BaseRepository;
use App\Repositories\Cart\CartItemRepositoryInterface;

class CartItemRepository extends BaseRepository implements CartItemRepositoryInterface{
    public function getModel(){
        return CartItem::class;
    }
    public function getAllInsideCart($cartID){
        return CartItem::select('CartItemID','Quantity')
        ->where('CartID',$cartID)
        ->get();
    }
    public function getProductByCartID($cartID){
        return CartItem::select('ProductID','VariantID','Quantity')  // variant only go with product
        ->where('CartID',$cartID)
        ->whereNotNull('ProductID')
        ->get();
    }
    public function getComboByCartID($cartID){
        return CartItem::select('ComboID','Quantity')
        ->where('CartID',$cartID)
        ->whereNotNull('ComboID')
        ->get();
    }
    public function emptyCart($cart_id): ?bool
    {
        return (new \App\Models\CartItem)->where('CartID',$cart_id)
            ->delete();
    }
}
