<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class ListRequest extends FormRequest
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
        $rules=  [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'code' => ['sometimes', 'in:calendar,calendar,needs,wishlist,tasks'], // Enum values for reminder_day
            'reminder_day' => ['sometimes', 'in:one_day,two_day,three_day'], // Enum values for reminder_day
            'reminder_hour' => ['sometimes', 'in:one_hour,three_hour,sex_hour'], // Enum values for reminder_hour
            'save_status_weekly' => 'sometimes',
            'date' => 'required|date:code,needs,wishlist,tasks',
            'house_id' => 'required|exists:houses,id',
        ];

        if ($this->isMethod('put')) {
            $rules['title'] = 'nullable|string|max:255';
            $rules['description'] ='nullable|string';
            $rules['code'] = ['nullable', 'in:calendar,calendar,needs,wishlist,tasks'];
            $rules['reminder_day'] = ['nullable:code,calendar', 'in:one_day,two_day,three_day'];
            $rules['reminder_hour'] = ['nullable:code,calendar', 'in:one_hour,three_hour,sex_hour'];
            $rules['save_status_weakly'] = 'nullable';
            $rules['date'] = 'nullable|date:code,needs,wishlist,tasks';
            $rules['house_id'] = 'nullable|exists:houses,id';
        }
        return  $rules ;
    }

    public function messages()
    {
        return [
            'title.required' => 'يرجى ادخال العنوان',
            'title.string' => 'يجب أن يكون العنوان نص',
            'description.required' => 'يرجى ادخال الوصف',
            'reminder_day.required' => 'يرجى ادخال التذكير باليوم',
            'reminder_day.in' => 'قيمة التذكير باليوم غير صحيحة',
            'reminder_hour.required' => 'يرجى ادخال التذكير بالساعة',
            'reminder_hour.in' => 'قيمة التذكير بالساعة غير صحيحة',
            'save_status_weekly.required' => 'يرجى ادخال حالة الحفظ الأسبوعي',
            'date.required' => 'يرجى إدخال التاريخ',
            'code.required' => 'يجب ادخال الكود المخصص للقائمة',
            'code.in' => 'قيمةالكود الخاص بالقائمة  غير صحيحة',
            'house_id.required' => 'يرجى ادخال البيت',
            'house_id.exists' => 'هذا البيت غير موجود',
            'date.date' => 'يجب ادخال التاريخ بالصيغة الصحيحة',

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['message' => $validator->errors()->first()], 400)
        );
    }


}
