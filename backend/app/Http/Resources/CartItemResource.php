<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'cartItemId' => $this->cart_item_id,
            'cartId' => $this->cart_id,
            'productId' => $this->product_id,
            'variantId' => $this->variant_id,
            'combo_id' => $this->combo_id,
            'quantity' => $this->quantity
        ];
    }
}
