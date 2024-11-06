<?php

namespace App\DTOs\InputData;

use Illuminate\Support\Facades\DB;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Numeric;
use Spatie\LaravelData\Attributes\Validation\RequiredIf;
use Spatie\LaravelData\Attributes\Validation\RequiredWithout;
use Spatie\LaravelData\Attributes\Validation\RequiredWithoutAll;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;
use Spatie\LaravelData\Optional;

#[MapInputName(CamelCaseMapper::class)]
class CartItemInputData extends Data
{
        public int|Optional $cart_item_id;
        #[RequiredWithout('cart_item_id')]
        public ?int $cart_id;
        #[MapInputName('productId'), RequiredWithoutAll('cart_item_id','combo_id_fk')]
        public ?int $product_id_fk;
        #[MapInputName('variantId'),Exists('product_variants','variant_id'), Unique('cart_items','variant_id_fk')]
        public ?int $variant_id_fk;
        #[MapInputName('comboId'), Exists('combos', 'combo_id'),Unique('cart_items', 'combo_id_fk'),RequiredWithoutAll('product_id_fk','cart_item_id')]
        public ?int $combo_id_fk;
        #[Numeric]
        public ?int $quantity;
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
