<?php

namespace App\DTOs\InputData;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;
use Spatie\LaravelData\Optional;

#[MapInputName(CamelCaseMapper::class)]
class ComboInputData extends Data
{
    #[Exists('combos, combo_id')]
    public int|Optional $combo_id;
    public int|Optional $combo_name;
    public string|Optional $description;
    public int|Optional $price;
    public int|Optional $combo_price_after_sale;
    public int|Optional $combo_sale;
    public int|Optional $category_id;
    public function has(string $propertyName): bool
    {
        return isset($this->{$propertyName}) && !($this->{$propertyName} instanceof \Illuminate\Support\Optional);
    }
}
