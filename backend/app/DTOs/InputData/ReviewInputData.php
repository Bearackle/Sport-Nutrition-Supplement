<?php

namespace App\DTOs\InputData;

use Illuminate\Support\Facades\DB;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;
use Spatie\LaravelData\Optional;

#[MapInputName(CamelCaseMapper::class)]
class ReviewInputData extends Data
{
    public int|Optional $review_id;
    #[MapInputName('productId')]
    public int|Optional|null $product_id;
    public int|Optional|null $combo_id;
    public int|Optional $rating;
    public int|Optional $user_id;
    public string|Optional $comment;
    public static function rules(): array
    {
        return [
            'product_id' => [
                function ($attribute, $value, $fail) {
                    if (!($value instanceof Optional) && !DB::table('products')->where('product_id', $value)->exists()) {
                        $fail("The selected $attribute is invalid.");
                    }
                },
            ],
            'review_id' => [
                function ($attribute, $value, $fail) {
                    if (!($value instanceof Optional) && !DB::table('reviews')->where('review_id', $value)->exists()) {
                        $fail("The selected $attribute is invalid.");
                    }
                },
            ],
            'combo_id' => [
                function ($attribute, $value, $fail) {
                    if (!($value instanceof Optional) && !DB::table('combos')->where('combo_id', $value)->exists()) {
                        $fail("The selected $attribute is invalid.");
                    }
                },
            ]
        ];
    }
    public function has(string $propertyName): bool
    {
        return isset($this->{$propertyName}) && !($this->{$propertyName} instanceof Optional);
    }
}
