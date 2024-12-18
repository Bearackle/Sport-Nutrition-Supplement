<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComboCartItems extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "cartItemId" => $this->pivot->cart_item_id,
            "comboId" => $this->combo_id,
            "comboName" => $this->combo_name,
            "price"     => $this->price,
            "comboSale"   => $this->combo_sale,
            "comboPriceAfterSale" => $this->combo_price_after_sale,
            "comboImageUrl" => $this->combo_image_url,
            "categoryId" => $this->category_id,
            "quantity" => $this->pivot->quantity
        ];
    }
}
