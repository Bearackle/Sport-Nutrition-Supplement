<?php

namespace App\DTOs\InputData;

use Illuminate\Support\Optional;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;

class VariantInputData extends Data
{
    public function __construct(
        #[Exists('product_variants, variant_id')]
        public int|Optional $variant_id,
        #[Exists('products, product_id')]
        public int|Optional $product_id,
        public string|Optional $variant_name,
        public string|Optional $stock_quantity,
    ){}
}
