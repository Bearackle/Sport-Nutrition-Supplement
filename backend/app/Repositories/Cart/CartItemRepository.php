<?php

namespace App\Repositories\Cart;

use App\Models\CartItem;
use App\Repositories\BaseRepository;
use App\Repositories\Cart\CartItemRepositoryInterface;

class CartItemRepository extends BaseRepository implements CartItemRepositoryInterface{
    public function getModel(): string
    {
        return CartItem::class;
    }
    public function getAllInsideCart($cartId): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\CartItem)->select('cart_item_id','quantity')
        ->where('cart_id',$cartId)
        ->get();
    }
    public function getProductByCartID($cartId): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\CartItem)->select('product_id','variant_id','quantity')  // variant only go with product
        ->where('cart_id',$cartId)
        ->whereNotNull('product_id')
        ->get();
    }
    public function getComboByCartID($cartId): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\CartItem)->select('combo_id','quantity')
        ->where('cart_id',$cartId)
        ->whereNotNull('combo_id')
        ->get();
    }
    public function emptyCart($cartId): ?bool
    {
        return (new \App\Models\CartItem)->where('cart_id',$cartId)
            ->delete();
    }
    public function upadateVersion($cartId, $variantId,$version){
        return (new \App\Models\CartItem)->where('cart_id',$cartId)
            ->where('variant_id_fk',$variantId)
            ->update(['version'=>$version]);
    }
}
