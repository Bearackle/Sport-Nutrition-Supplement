<?php

namespace App\DTOs\InputData;

use Illuminate\Support\Optional;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;

#[MapInputName(CamelCaseMapper::class)]
class VariantInputData extends Data
{
        #[Exists('product_variants, variant_id')]
        public int|Optional $variant_id;
        #[Exists('products, product_id')]
        public int|Optional $product_id;
        public string|Optional $variant_name;
        public string $stock_quantity;

    public function has(string $propertyName): bool
    {
        return isset($this->{$propertyName}) && !($this->{$propertyName} instanceof Optional);
    }
}
