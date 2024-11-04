<?php

namespace App\DTOs\InputData;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;
use Spatie\LaravelData\Optional;
#[MapInputName(CamelCaseMapper::class)]
class OrderItemInputData extends Data
{
    #[Exists('order_details,order_detail_id')]
    public int|Optional $order_detail_id;
    #[Exists('orders,order_id')]
    public int|Optional $order_id;
    #[Exists('products,product_id')]
    public int|Optional $product_id;
    #[Exists('product_variants,  variant_id')]
    public int|Optional $variant_id;
    #[Exists('combos, combo_id')]
    public int|Optional $combo_id;
    public int|Optional $unit_price;
    public int|Optional $quantity;
    public function has(string $propertyName): bool
    {
        return isset($this->{$propertyName}) && !($this->{$propertyName} instanceof \Illuminate\Support\Optional);
    }
}
