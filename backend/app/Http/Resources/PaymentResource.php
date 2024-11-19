<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'paymentId' => $this->payment_id,
            'orderId' => $this->order_id,
            'paymentMethod' =>$this->payment_method->name,
            'paymentStatus' => $this->payment_status->name,
            'paymentDate' => $this->payment_date
        ];
    }
    public function withResponse(Request $request, JsonResponse $response): void
    {
        $response->setData($this->toArray($request));
    }
}