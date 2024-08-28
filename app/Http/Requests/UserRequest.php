<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
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
            'name' => 'sometimes|string',
            'email' => 'sometimes|email',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'divisor_type' => ['sometimes', 'in:daily,two_day,weakly',], // Enum values for reminder_day

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'يجب ادخال الإسم',
            'name.string' => 'يجب أن يكون الإسم نص',
            'email.required' => 'يجب ادخال البريد الإلكتروني',
            'email.email' => 'يجب ادخال بريد إلكتروني فعال',
            'image.required' => 'يجب ادخال الصورة الخاصة بالبيت',
            'image.image' => 'يجب ان يكون الملف من نوع صورة',
            'image.mimes' => 'فقط ملفات بصيغة JPEG, PNG, JPG, و GIF مسموح بها',
            'divisor_type.in' => 'قيمة القسمة  غير صحيحة',
            'email.exists' => 'هذا البريد غير موجود',
            'email.unique' => 'هذا البريد موجود مسبقا',

        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['message' => $validator->errors()->first()], 400)
        );
    }
}
