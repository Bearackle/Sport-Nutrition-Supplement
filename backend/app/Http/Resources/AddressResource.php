<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'addressId' => $this->address_id,
            'addressDetail' => $this->address_detail
        ];
    }
    public function withResponse(Request $request, JsonResponse $response): void
    {
        $response->setData($this->toArray($request));
    }
}
