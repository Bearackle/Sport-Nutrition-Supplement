<?php

namespace App\Http\Resources;

use App\Models\ImageLinkModels\ProductImages;
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
            'cartItemId' => $this->pivot->cart_item_id,
            'productId' => $this->product_id,
            'productName' => $this->product->product_name,
            'image' => $this->image == null ? $this->product->images->value('image_url') : $this->image,
            'priceAfterSale' => $this->product->price_after_sale,
            'price' => $this->product->price,
            'variantId' => $this->variant_id,
            'variantName' => $this->variant_name,
            'stockQuantity'=> $this->stock_quantity,
            'quantity' => $this->pivot->quantity,
        ];
    }
    public function has(string $propertyName): bool
    {
        return isset($this->{$propertyName});
    }
}
