<?php

namespace App\DTOs\OutputData;

use Spatie\LaravelData\Data;

class CartItemOutputData extends Data
{
    public function __construct(
        public int $cart_item_id,
        public int $cart_id,
        public ?int $product_id,
        public ?int $variant_id,
        public ?int $combo_id,
        public int $quantity){
    }
}
