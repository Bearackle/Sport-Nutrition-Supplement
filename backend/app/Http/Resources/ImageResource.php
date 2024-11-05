<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'imageId' => $this->image_id,
            'imageUrl' => $this->image_url,
            'publicId' => $this->public_id,
            'createAt' => $this->created_at
        ];
    }
}
