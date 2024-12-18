<?php

namespace App\DTOs\InputData;

use Illuminate\Support\Facades\DB;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Validation\RequiredWithout;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;
use Spatie\LaravelData\Optional;

#[MapInputName(CamelCaseMapper::class)]
class ComboInputData extends Data
{
    public int|Optional $combo_id;
    #[RequiredWithout('combo_id')]
    public string|Optional $combo_name;
    #[RequiredWithout('combo_id')]
    public string|Optional $description;
    #[RequiredWithout('combo_id')]
    public int|Optional $price;
    public int|Optional $combo_price_after_sale;
    public string|Optional $combo_image_url;
    #[RequiredWithout('combo_id')]
    public int|Optional $combo_sale;
    #[RequiredWithout('combo_id')]
    public int|Optional $category_id;
    public function has(string $propertyName): bool
    {
        return isset($this->{$propertyName}) && !($this->{$propertyName} instanceof Optional);
    }
    public static function rules(): array
    {
        return [
            'combo_id' => [
                function ($attribute, $value, $fail) {
                    if (!($value instanceof Optional) && !DB::table('combos')->where('combo_id', $value)->exists()) {
                        $fail("The selected $attribute is invalid.");
                    }
                },
            ]
        ];
    }
}
