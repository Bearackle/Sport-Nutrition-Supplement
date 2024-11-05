<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComboResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "combo" => $this->combo_name,
            "price"     => $this->price,
            "combSale"   => $this->combo_sale,
            "comboPriceAfterSale" => $this->combo_price_after_sale,
            "comboImageUrl" => $this->combo_image_url,
            "category_id" => $this->category_id,
            "products" => $this->has('variants') ?
                ProductVariantPivotResource::collection($this->variants) : null,
        ];
    }
    public function has(string $propertyName): bool
    {
        return isset($this->{$propertyName});
    }
}
