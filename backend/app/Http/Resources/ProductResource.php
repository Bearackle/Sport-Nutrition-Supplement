<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $ProductID
 */
class ProductResource extends JsonResource
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
            'ProductName' => $this->product_name,
            'description' => $this->description,
            'shortDescription' => $this->short_description,
            'price'=> $this->price,
            'sale' => $this->sale,
            'priceAfterSale' => $this->price_after_sale,
            'stockQuantity' => $this->stock_quantity,
            'category_id' => $this->category_id,
            'brand' => $this->brand_id,
            'images' => $this->images
        ];
    }
}
