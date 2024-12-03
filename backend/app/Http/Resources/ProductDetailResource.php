<?php

namespace App\Http\Resources;

use DOMDocument;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailResource extends JsonResource
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
            'productName' => $this->product_name,
            'description' => $this->description,
            'shortDescription' => $this->has('short_description') ? $this->transformShortDescription($this->short_description) : null,
            'price'=> $this->price,
            'sale' => $this->sale,
            'priceAfterSale' => $this->price_after_sale,
            'stockQuantity' => $this->has('stock_quantity') ? $this->stock_quantity : null,
            'categoryId' => $this->category_id,
            'brandId' => $this->brand_id,
            'images' => $this->images->pluck('image_url')->toArray(),
            'variants' => ProductVariantResource::collection($this->variants)
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
    public function transformShortDescription(string $shortDescription): array
    {
        $listItems = explode(',',$shortDescription);
        return array_map('trim', $listItems);
    }
}
