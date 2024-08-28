<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class HouseRequest extends FormRequest
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
        $userId = auth()->user()->id; // Obtain the authenticated user's ID

        $rules = [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'arrange' => [
                'required',
                'integer',
                'max:4',
                Rule::unique('houses', 'arrange')->where(function ($query) use ($userId) {
                    return $query->where('user_id', $userId);
                }),
            ],
            'color' => [
                'required',
                'max:255',
                'in:primary,blue,green,orange',
                Rule::unique('houses', 'color')->where(function ($query) use ($userId) {
                    return $query->where('user_id', $userId);
                }),
            ],
        ];

        if ($this->isMethod('put')) {
            $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
            $rules['name'] = 'nullable|string|max:255';
            $rules['address'] = 'nullable|string';
            $rules['arrange'] = [
                'nullable',
                'integer',
                'max:4',
                Rule::unique('houses', 'arrange')->where(function ($query) use ($userId) {
                    return $query->where('user_id', $userId);
                })->ignore($this->route('house')), // Exclude the current house being updated
            ];
            $rules['color'] = [
                'nullable',
                'max:255',
                'in:primary,blue,green,orange',
                Rule::unique('houses', 'color')->where(function ($query) use ($userId) {
                    return $query->where('user_id', $userId);
                })->ignore($this->route('house')), // Exclude the current house being updated
            ];
        }

        return $rules;
    }


    public function messages()
    {
        return [
            'image.required' => 'يجب ادخال الصورة الخاصة بالبيت',
            'image.image' => 'يجب ان يكون الملف من نوع صورة',
            'image.mimes' => 'فقط ملفات بصيغة JPEG, PNG, JPG, و GIF مسموح بها',
            'image.max' => 'حجم الصورة لا يمكن أن يتجاوز 2 ميجابايت',
            'address.required' => 'يجب ادخال العنوان',
            'color.required' => 'يرجى إدخال لون المنزل',
            'color.string' => 'يجب أن يكون لون المنزل نصًا',
            'color.unique' => 'هذا اللون موجود بالفعل في السجلات',
            'color.in' => 'قيمة اللون  غير صحيحة',
            'color.max' => 'الحد الأقصى لعدد الأحرف هو 255',
            'name.required' => 'يرجى ادخال اسم الشخص الخاص بك',
            'arrange.required' => 'يرجى إدخال القيمة',
            'arrange.integer' => 'يجب أن تكون القيمة عددًا صحيحًا',
            'arrange.max' => 'الحد الأقصى للقيمة هو 4',
            'arrange.unique' => 'هذا الترتيب موجودة بالفعل في السجلات',
            'name.max' => 'يجب أن يكون اسمك أقل من 255 حرف',
            'name.string' => 'يجب أن يكون الاسم نص',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['message' => $validator->errors()->first()], 400)
        );
    }

}
