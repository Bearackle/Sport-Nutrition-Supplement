<?php

namespace App\Http\Resources;

use App\Enum\PaymentMethod;
use App\Enum\PaymentStatus;
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
            'paymentMethod' =>PaymentMethod::tryFrom($this->payment_method)->name,
            'paymentStatus' => PaymentStatus::tryFrom($this->payment_status)->name,
            'paymentDate' => $this->payment_date
        ];
    }
    public function withResponse(Request $request, JsonResponse $response): void
    {
        $response->setData($this->toArray($request));
    }
}
