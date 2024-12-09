<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use phpDocumentor\Reflection\Types\Boolean;

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
            'products' => ProductVariantPivotResource::collection($this->variants),
            'combos' =>   ComboCartItems::collection($this->combos),
            'isAvailable' => $this->isAvailable()
        ];
    }
    public function withResponse(Request $request, JsonResponse $response): void
    {
        $response->setData($this->toArray($request));
    }
    public function isAvailable(){
        $available = true;
        foreach ($this->variants as $product){
            if($product->stock_quantity < $product->pivot->quantity){
                $available = false;
            }
        }
        return $available;
    }
}
