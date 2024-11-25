<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class NewCartItems extends FormRequest
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
            'CartID' => 'required | exists:shopping_carts,CartID',
            'ProductID' => 'nullable|exists:products,ProductID',
            'VariantID' => 'nullable|exists:product_variants,VariantID|unique:cart_items,VariantID',
            'ComboID' => 'nullable|exists:combos,ComboID|unique:cart_items,ComboID',
            'Quantity' => 'required | integer',
        ];
    }
    public function messages() : array
    {
       return [
           'VariantID.unique' => 'Variant ID already exists',
           'ComboID.unique' => 'Combo ID already exists',
       ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(
            [
                'errors' => $errors,
                'status' => 422,
            ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
