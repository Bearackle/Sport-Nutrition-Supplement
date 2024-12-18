<?php

namespace App\DTOs\InputData;

use App\DTOs\Casts\EnumAutoCast;
use App\DTOs\Casts\EnumShippingMethod;
use App\Enum\ShipMethod;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Validation\Enum;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;
use Spatie\LaravelData\Optional;

#[MapInputName(CamelCaseMapper::class)]
class ShippingMethodInputData extends Data
{
    #[Exists('orders, order_id')]
    public int|Optional $order_id;
    #[WithCast(EnumAutoCast::class)]
    public ShipMethod $method;
}
