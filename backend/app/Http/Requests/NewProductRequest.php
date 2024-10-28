<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

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
            'Images[]' => 'image|array|mimes:jpg, jpeg,webp, png'
//            'Variants' => 'array',
//            'Variants.*.VariantName' => 'string',
//            'Variants.*.StockQuantity' => 'numeric',
//            'Variants.*.Image' => 'image|mimes:jpg,webp, jpeg, png'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(
            [
                'error' => $errors,
                'status_code' => 422,
            ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
