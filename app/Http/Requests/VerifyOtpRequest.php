<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class VerifyOtpRequest extends FormRequest
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
    public function rules()
    {
        return [
            'email' => 'required|email',
            'otp' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'يرجى ادخال البريد الإلكتروني الخاص بك',
            'otp.max' => 'تحقق حقل رمز التحقق (OTP) يجب أن يتكون من 4 أرقام',
            'otp.required' => 'يرجى ادخال رمز التفعيل',


        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['message' => $validator->errors()->first()], 400)
        );
    }
}
