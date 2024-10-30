<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CombosLandingMask extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "ComboName" => $this->ComboName,
            "Price"     => $this->Price,
            "Cb_Sale"   => $this->Cb_Sale,
            "Cb_PriceAfterSale" => $this->Cb_PriceAfterSale,
            "Cb_ImageURL" => $this->Cb_ImageURL,
            "CategoryID" => $this->CategoryID
        ];
    }
}
