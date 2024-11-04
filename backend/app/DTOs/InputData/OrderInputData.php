<?php

namespace App\DTOs\InputData;

use App\Enum\OrderStatus;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;
use Spatie\LaravelData\Optional;

#[MapInputName(CamelCaseMapper::class)]
class OrderInputData extends Data
{
    #[Exists('orders, order_id')]
    public int|Optional $order_id;
    #[Exists('users, user_id')]
    public int|Optional $user_id;
    public OrderStatus|Optional $status;
    public int|Optional $note;
    public int|Optional $address_detail;
    public int|Optional $shipment_charges;

    public function has(string $propertyName): bool
    {
        return isset($this->{$propertyName}) && !($this->{$propertyName} instanceof \Illuminate\Support\Optional);
    }
}
