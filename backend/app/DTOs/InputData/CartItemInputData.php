<?php

namespace App\DTOs\InputData;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Optional;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\RequiredWithout;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;

#[MapInputName(CamelCaseMapper::class)]
class CartItemInputData extends Data
{
        public int $cart_item_id;
        #[RequiredWithout('cart_item_id')]
        public ?int $cart_id;
        #[RequiredWithout('cart_item_id')]
        public ?int $product_id;
        #[Exists('product_variants', 'variant_id'), Unique('cart_items','variant_id'),]
        public ?int $variant_id;
        #[Exists('combos', 'combo_id'),Unique('cart_items', 'combo_id')]
        public ?int $combo_id;
        public int $quantity;
    public function has(string $propertyName): bool
    {
        return isset($this->{$propertyName}) && !($this->{$propertyName} instanceof Optional);
    }
    public static function rules(): array
    {
        return [
            'cart_item_id' => [
                function ($attribute, $value, $fail) {
                    if (!($value instanceof \Spatie\LaravelData\Optional) && !DB::table('cart_items')->where('cart_item_id', $value)->exists()) {
                        $fail("The selected $attribute is invalid.");
                    }
                },
            ]
        ];
    }
}
