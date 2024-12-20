<?php

namespace App\DTOs\Casts;

use App\Enum\ShipMethod;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class EnumShippingMethod implements Cast
{

    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        return ShipMethod::equals($value);
    }
}
