<?php

namespace App\DTOs\InputData;

use Illuminate\Support\Optional;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;

#[MapInputName(CamelCaseMapper::class)]
class ComboProductInputData extends Data
{
    #[Exists('combo_products,combo_product_id')]
    public int|Optional $combo_product_id;
    #[Exists('combos,combo_id')]
    public int|Optional $combo_id;
    #[Exists('products,product_id')]
    public int|Optional $product_id;
    #[Exists('product_variants,variant_id')]
    public int|Optional $variant_id;
    public int|Optional $quantity;

    public function has(string $propertyName): bool
    {
        return isset($this->{$propertyName}) && !($this->{$propertyName} instanceof Optional);
    }
}
