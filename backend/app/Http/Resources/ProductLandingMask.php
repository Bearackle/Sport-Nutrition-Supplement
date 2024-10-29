<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductLandingMask extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ProductID' => $this->ProductID,
            'ProductName' => $this->ProductName,
            'Price'=> $this->Price,
            'Sale' => $this->Sale,
            'PriceAfterSale' => $this->PriceAfterSale,
            'Images[]' => $this->images
        ];
    }
}
