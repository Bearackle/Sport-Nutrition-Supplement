<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'cartId' => $this->cart_id,
            'userId' => $this->user_id,
            'products' => ProductVariantPivotResource::collection($this->variants),
            'combos' =>   ComboProductResource::collection($this->combos)
        ];
    }
}
