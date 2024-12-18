<?php

namespace App\DTOs\OutputData;

use Carbon\Carbon;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class ReviewOutputData extends Data
{
    public int|Optional $review_id;
    public int|Optional $user_id;
    public int|Optional$product_id;
    public int|Optional $combo_id;
    public int|Optional $rating;
    public string|Optional $comment;
    public Carbon|Optional $created_at;
    public Carbon|Optional $updated_at;
    public function has(string $propertyName): bool
    {
        return isset($this->{$propertyName}) && !($this->{$propertyName} instanceof Optional);
    }
}
