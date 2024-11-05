<?php

namespace App\DTOs\InputData;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use PhpOption\Option;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\RequiredUnless;
use Spatie\LaravelData\Attributes\Validation\RequiredWith;
use Spatie\LaravelData\Attributes\Validation\RequiredWithout;
use Spatie\LaravelData\Attributes\Validation\Sometimes;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;
use Spatie\LaravelData\Optional;

#[MapInputName(CamelCaseMapper::class)]

class ProductIntputData extends Data
{
    public int|Optional $product_id;
    #[RequiredWithout('product_id')]
    public string|Optional $product_name;
    #[RequiredWithout('product_id')]
    public string|Optional $description;
    public string|Optional $short_description;
    #[RequiredWithout('product_id')]
    public int|Optional $price;
    public int|Optional $price_after_sale;
    #[RequiredWithout('product_id')]
    public int|Optional $sale;
    #[RequiredWithout('product_id')]
    public int|Optional $stock_quantity;
    #[RequiredWithout('product_id')]
    public int|Optional $category_id;
    #[RequiredWithout('product_id')]
    public int|Optional $brand_id;
    public function has(string $propertyName): bool
    {
        return isset($this->{$propertyName}) && !($this->{$propertyName} instanceof Optional);
    }
    public static function rules(): array
    {
        return [
            'product_id' => [
                function ($attribute, $value, $fail) {
                    if (!($value instanceof Optional) && !DB::table('products')->where('product_id', $value)->exists()) {
                        $fail("The selected $attribute is invalid.");
                    }
                },
            ]
        ];
    }
}
