<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'productId' => $this->variants->product_id,
            'variantId' => $this->variants->variant_id,
            'variantName' => $this->variants->variant_name,
            'productName' => $this->variants->product->product_name,
            'price' => $this->variants->price,
            'priceAfterSale' => $this->variants->product->unit_price,
            'quantity'=> $this->variants->pivot->quantity,
        ];
    }
}
