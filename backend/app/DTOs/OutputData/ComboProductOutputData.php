<?php

namespace App\DTOs\OutputData;

use Spatie\LaravelData\Data;

class ComboProductOutputData extends Data
{
    public function __construct(
        public int $combo_product_id,
        public int $combo_id,
        public int $product_id,
        public int $variant_id,
        public int $quantity,
    ){}
}
