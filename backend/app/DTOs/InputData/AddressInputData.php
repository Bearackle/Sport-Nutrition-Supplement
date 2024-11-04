<?php

namespace App\DTOs\InputData;

use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class AddressInputData extends Data
{
    #[Exists('addresses,address_id')]
    public int|Optional $address_id;
    #[Exists('users, user_id')]
    public int|Optional $user_id;
    public string|Optional $address_detail;
    public function has(string $propertyName): bool
    {
        return isset($this->{$propertyName}) && !($this->{$propertyName} instanceof \Illuminate\Support\Optional);
    }
}
