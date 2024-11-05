<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariantPivotResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'productId' => $this->product_id,
            'productName' => $this->product->product_name,
            'price_after_sale' => $this->product->price_after_sale,
            'variantId' => $this->variant_id,
            'variantName' => $this->variant_name,
            'quantity' => $this->pivot->quantity,
        ];
    }
}
