<?php

namespace App\DTOs\InputData;

use Illuminate\Support\Facades\DB;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;
use Spatie\LaravelData\Optional;

#[MapInputName(CamelCaseMapper::class)]
class ComboProductInputData extends Data
{
    public int|Optional $combo_product_id;
    public int|Optional $combo_id;
    public int|Optional $product_id;
    public int|Optional $variant_id;
    public int|Optional $quantity;

    public function has(string $propertyName): bool
    {
        return isset($this->{$propertyName}) && !($this->{$propertyName} instanceof Optional);
    }
    public static function rules(): array
    {
        return [
            'combo_product_id' => [
                function ($attribute, $value, $fail) {
                    if (!($value instanceof \Spatie\LaravelData\Optional) && !DB::table('combo_products')->where('combo_product_id', $value)->exists()) {
                        $fail("The selected $attribute is invalid.");
                    }
                },
            ],
            'combo_id' => [
                function ($attribute, $value, $fail) {
                    if (!($value instanceof \Spatie\LaravelData\Optional) && !DB::table('combos')->where('combo_id', $value)->exists()) {
                        $fail("The selected $attribute is invalid.");
                    }
                },
            ],
             'product_id_fk' => [
                function ($attribute, $value, $fail) {
                    if (!($value instanceof \Spatie\LaravelData\Optional) && !DB::table('products')->where('product_id', $value)->exists()) {
                        $fail("The selected $attribute is invalid.");
                    }
                }
            ],
            'variant_id_fk' => [
                function ($attribute, $value, $fail) {
                    if (!($value instanceof \Spatie\LaravelData\Optional) && !DB::table('product_variants')->where('variant_id', $value)->exists()) {
                        $fail("The selected $attribute is invalid.");
                    }
                }
            ],
        ];
    }
}
