<?php

namespace App\DTOs\InputData;

use App\Enum\PaymentMethod;
use App\Enum\PaymentStatus;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;
use Spatie\LaravelData\Optional;
#[MapInputName(CamelCaseMapper::class)]
class PaymentInputData extends Data
{
    #[Exists('payments,payment_id')]
    public int|Optional $payment_id;
    #[Exists('orders, order_id')]
    public int|Optional $order_id;
    public PaymentStatus|Optional $payment_status;
    public PaymentMethod|Optional $payment_method;

    public function has(string $propertyName): bool
    {
        return isset($this->{$propertyName}) && !($this->{$propertyName} instanceof \Illuminate\Support\Optional);
    }
}
