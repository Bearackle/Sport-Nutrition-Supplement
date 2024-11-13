<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Optional;

class VariantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'variantId' =>  $this->variant_id,
            'productId' => $this->product_id,
            'variantName' => $this->variant_name,
            'stockQuantity' => $this->has('stock_quantity') ? $this->stock_quantity : null,
            'image' => $this->has('image') ? new ImageResource($this->image) : null,
        ];
    }
    public function has(string $propertyName): bool
    {
        return isset($this->{$propertyName});
    }
    public function withResponse(Request $request, JsonResponse $response): void
    {
        $response->setData($this->toArray($request));
    }
}
