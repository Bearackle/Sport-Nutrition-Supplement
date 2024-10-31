<?php

namespace App\DTOs\OutputData;

use Carbon\Carbon;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;

class ShoppingCartOutputData extends Data
{
       public function __construct(
           public int $cart_id,
        public int $user_id,
        #[WithCast(DateTimeInterfaceCast::class), MapInputName(CamelCaseMapper::class)]
        public ?\DateTime $created_at){}
}
