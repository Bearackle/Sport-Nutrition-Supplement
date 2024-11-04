<?php

namespace App\DTOs\OutputData;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class ComboOutputData extends Data
{
    public function __construct(
        public int $combo_id,
        public int $combo_name,
        public string $description,
        public int $price,
        public int $combo_sale,
        public int $category_id
    ){}
}
