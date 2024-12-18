<?php

namespace App\DTOs\OutputData;

use Spatie\LaravelData\Data;

class AddressOutputData extends Data
{
    public function __construct(
        public int $address_id,
        public int $user_id,
        public string $address_detail
    ){}
}
