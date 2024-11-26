<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class UpdatePasswordRequest extends FormRequest
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
            'currentPassword' => ['required','string','min:6','regex:/[a-zA-Z]/', 'regex:/[0-9]/'],
            'newPassword' => ['required','string','min:6','regex:/[a-zA-Z]/', 'regex:/[0-9]/',function ($attribute, $value, $fail) {
             if($value == $this->input('currentPassword')){
                 $fail('The new password must not be the same as the current password');
             }
            }],
            'confirmPassword' => 'required | same:newPassword'
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
