<?php

namespace App\DTOs\OutputData;


use Spatie\LaravelData\Data;

class VariantOutputData extends Data
{
        public int $variant_id;
        public int $product_id;
        public string $variant_name;
        public string $stock_quantity;
}
