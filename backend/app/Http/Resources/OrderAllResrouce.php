<?php

namespace App\Http\Resources;

use App\Enum\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\LaravelData\Optional;
use Symfony\Component\HttpFoundation\JsonResponse;

class OrderAllResrouce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'orderId' => $this->order_id,
            'createdDate' => $this->order_date,
            'totalAmount' => $this->total_amount,
            'note' => $this->note,
            'status' => OrderStatus::tryFrom($this->status)->label(),
            'addressDetail' => $this->address_detail instanceof Optional ? null : $this->address_detail,
            'shipmentCharges' =>  $this->shipment_charges instanceof Optional ? null : $this->shipment_charges,
            'products' => OrderProductsWithImagesResource::collection($this->variants)
        ];
    }
    public function withResponse(Request $request,JsonResponse $response): void
    {
        $response->setData($this->toArray($request));
    }
}
