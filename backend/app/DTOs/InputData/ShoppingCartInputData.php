<?php

namespace App\DTOs\InputData;
use DateTime;
use Illuminate\Support\Optional;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;

class ShoppingCartInputData extends Data
{
    public function __construct(
        public ?int $cart_id,
        #[Exists('users','user_id'),Unique('shopping_carts','user_id'),MapInputName(CamelCaseMapper::class)]
        public ?int $user_id,
        #[WithCast(DateTimeInterfaceCast::class)]
        public ?DateTime $created_at
    ){}

    public function has(string $propertyName): bool
    {
        return isset($this->{$propertyName}) && !($this->{$propertyName} instanceof Optional);
    }
}
