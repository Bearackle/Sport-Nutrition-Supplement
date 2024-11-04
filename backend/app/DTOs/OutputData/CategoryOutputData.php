<?php

namespace App\DTOs\OutputData;

use Spatie\LaravelData\Data;

class CategoryOutputData extends Data
{
    public function __construct(
        public int $category_id,
        public string $category_name){}
}
