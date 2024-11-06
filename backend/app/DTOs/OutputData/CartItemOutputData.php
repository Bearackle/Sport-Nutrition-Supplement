<?php

namespace App\DTOs\OutputData;

use App\Models\Combo;
use App\Models\Product;
use App\Models\ProductVariant;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class CartItemOutputData extends Data
{
    public int $cart_item_id;
    public int $cart_id;
    #[MapInputName('variant_id_fk')]
    public ?int $variant_id;
    #[MapInputName('product_id_fk')]
    public ?int $product_id;
    #[MapInputName('combo_id_fk')]
    public ?int $combo_id;
    public int $quantity;
}
