<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'reviewId' => $this->review_id,
            'user'     => $this->has('user') ? new UserResource($this->user) : null,
            'productId' => $this->has('product_id') ? $this->product_id : null,
            'comboId' => $this->has('combo_id') ? $this->combo_id : null,
            'rating' => $this->rating,
            'comment' => $this->comment,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];
    }
    public function has(string $propertyName): bool
    {
        return isset($this->{$propertyName});
    }
}
