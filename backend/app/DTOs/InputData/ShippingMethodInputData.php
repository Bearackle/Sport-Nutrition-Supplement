<?php

namespace App\DTOs\InputData;

use App\Enum\ShipMethod;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;

#[MapInputName(CamelCaseMapper::class)]
class ShippingMethodInputData extends Data
{
    #[Exists('orders, order_id')]
    public int $order_id;
    public ShipMethod $method;
}
