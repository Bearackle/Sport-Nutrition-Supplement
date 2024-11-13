<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserFullResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'userId' => $this->user_id,
            'name' => $this->name,
            'email' => $this->email,
            'emailVerifiedAt' =>$this->email_verified_at,
            'phone' => $this->phone,
            'createAt' => $this->created_at,
            'updateAt' => $this->updated_at
        ];
    }
}
