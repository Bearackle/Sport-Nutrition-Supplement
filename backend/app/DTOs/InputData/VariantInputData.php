<?php

namespace App\DTOs\InputData;

use Illuminate\Support\Facades\DB;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\RequiredWithout;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;
use Spatie\LaravelData\Optional;

#[MapInputName(CamelCaseMapper::class)]
class VariantInputData extends Data
{
        public int|Optional $variant_id;
        public int|Optional $product_id;
        #[RequiredWithout('variant_id')]
        public string|Optional $variant_name;
        #[RequiredWithout('variant_id')]
        public int|Optional $stock_quantity;

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
