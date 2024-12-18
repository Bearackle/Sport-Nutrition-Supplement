<?php

namespace App\DTOs\InputData;

use Illuminate\Support\Facades\DB;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;
use Spatie\LaravelData\Optional;
#[MapInputName(CamelCaseMapper::class)]
class AddressInputData extends Data
{
    public ?int $address_id;
    public int|Optional $user_id;
    public ?string $address_detail;
    public function has(string $propertyName): bool
    {
        return isset($this->{$propertyName}) && !($this->{$propertyName} instanceof Optional);
    }
    public static function rules(): array
    {
        return [
            'user_id' => [
                function ($attribute, $value, $fail) {
                    if (!($value instanceof Optional) && !DB::table('users')->where('user_id', $value)->exists()) {
                        $fail("The selected $attribute is invalid.");
                    }
                },
            ]
        ];
    }
}
