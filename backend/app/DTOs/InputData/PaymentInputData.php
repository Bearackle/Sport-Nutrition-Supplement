<?php

namespace App\DTOs\InputData;

use App\DTOs\Casts\EnumAutoCast;
use App\Enum\PaymentMethod;
use App\Enum\PaymentStatus;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\WithCast;
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
    #[WithCast(EnumAutoCast::class)]
    public PaymentStatus|Optional $payment_status;
    #[WithCast(EnumAutoCast::class)]
    public PaymentMethod|Optional $payment_method;

    public function has(string $propertyName): bool
    {
        return isset($this->{$propertyName}) && !($this->{$propertyName} instanceof \Illuminate\Support\Optional);
    }
    public static function rules(): array
    {
        return [
            'order_id' => [
                function ($attribute, $value, $fail) {
                    if (!($value instanceof Optional) && !DB::table('orders')->where('order_id', $value)->exists()) {
                        $fail("The selected $attribute is invalid.");
                    }
                },
            ],
            'payment_id' => [
                function ($attribute, $value, $fail) {
                    if (!($value instanceof Optional) && !DB::table('payment')->where('payment_id', $value)->exists()) {
                        $fail("The selected $attribute is invalid.");
                    }
                },
            ],
        ];
    }
}
