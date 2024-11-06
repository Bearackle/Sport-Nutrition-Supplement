<?php

namespace App\DTOs\InputData;

use App\DTOs\Casts\EnumAutoCast;
use App\Enum\OrderStatus;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;
use Spatie\LaravelData\Optional;

#[MapInputName(CamelCaseMapper::class)]
class OrderInputData extends Data
{
    public int|Optional $order_id;
    public int|Optional $user_id;
    #[WithCast(EnumAutoCast::class)]
    public OrderStatus|Optional $status;
    public string|Optional $note;
    public string|Optional $address_detail;
    public int|Optional $shipment_charges;
    public function has(string $propertyName): bool
    {
        return isset($this->{$propertyName}) && !($this->{$propertyName} instanceof Optional);
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
        ];
    }
}
