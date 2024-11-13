<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageRatingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ratingImageId' => $this->rating_image_id,
            'ratingImageUrl' => $this->rating_image_url,
            'createdAt' => $this->created_at
        ];
    }
}
