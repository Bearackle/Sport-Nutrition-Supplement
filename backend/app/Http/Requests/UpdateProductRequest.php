<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
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
            'ImageID' => 'array',
            'Images[]' => 'image|mimes:jpg, jpeg, png, webp',
        ];
    }
}
