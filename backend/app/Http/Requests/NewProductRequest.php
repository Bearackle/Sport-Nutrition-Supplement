<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'ProductName' => 'required | string',
            'Description' => 'required | string',
            'Short_Description' => 'string',
            'Price' => 'required | numeric',
            'Sale' => 'required | numeric',
            'StockQuantity' => 'required | numeric',
            'CategoryID' => 'required',
            'BrandID' => 'required',
            'Images[]' => 'image|mimes:jpg, jpeg, png, webp',
            'Variants' => 'array',
            'Variants.*.VariantName' => 'string',
            'Variants.*.StockQuantity' => 'numeric',
            'Variants.*.Image[]' => 'image|mimes:jpg, jpeg, png, webp'
        ];
    }
}
