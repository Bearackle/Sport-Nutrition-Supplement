<?php

namespace App\Http\Resources;

use App\Enum\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'status' => $this->status->label(),
            'addressDetail' => $this->has('address_detail') ? $this->address_detail : null,
            'shipmentCharges' => $this->has('shipment_charges') ? $this->shipment_charges : null
        ];
    }
    public function has(string $propertyName): bool
    {
        return isset($this->{$propertyName});
    }
}
