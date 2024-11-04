<?php

namespace App\DTOs\InputData;

use Illuminate\Support\Optional;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;

class CartItemInputData extends Data
{
    public function __construct(
        #[Exists('shopping_carts','cart_id')]
        public int $cart_id,
        #[Exists('products', 'product_id')]
        public ?int $product_id,
        #[Exists('product_variants', 'variant_id'), Unique('cart_items','variant_id')]
        public ?int $variant_id,
        #[Exists('combos', 'combo_id'),Unique('cart_items', 'combo_id')]
        public ?int $combo_id,
        public int $quantity
    ){}
    public function has(string $propertyName): bool
    {
        return isset($this->{$propertyName}) && !($this->{$propertyName} instanceof Optional);
    }
}
