<?php

namespace App\DTOs\Casts;

use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class EnumAutoCast implements Cast
{

    /**
     * @throws \Exception
     */
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        $enumClass = $property->type->type->name;
        if($enumClass === null) {
            throw new \Exception("Enum class not defined");
        }
        return $enumClass::equals($value);
    }
}
