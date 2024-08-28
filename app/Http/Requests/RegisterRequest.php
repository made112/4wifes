<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'image' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'يرجى ادخال البريد الإلكتروني الخاص بك',
            'email.unique' => 'هذا البريد موجود مسبقا',
            'name.required' => 'يرجى ادخال إسم الشخصي الخاصة بك',
            'email.email' => 'يجب ادخال بريد إلكتروني فعال',
            'name.max' => 'يجب أن يكون إسمك أقل من 255 حرف',

        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['message' => $validator->errors()->first()], 400)
        );
    }
}


