<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'variantId' => $this->variant_id,
            'variantName' => $this->variant_name,
            'stockQuantity' => $this->stock_quantity
        ];
    }
}
