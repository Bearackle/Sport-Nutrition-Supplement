<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductsWithImagesResource extends JsonResource
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
            'variantId' => $this->variant_id,
            'variantName' => $this->variant_name,
            'productName' => $this->product->product_name,
            'price' => $this->product->price,
            'priceAfterSale' => $this->pivot->unit_price,
            'quantity'=> $this->pivot->quantity,
            'image' => $this->image == null ? $this->product->images->value('image_url') : $this->image->value('image_url')
        ];
    }
}
