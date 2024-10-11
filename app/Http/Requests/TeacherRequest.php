<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'name' => 'required|string|max:255', // يجب إدخال الاسم ويجب أن يكون نصًا بأقصى طول 255
            'email' => 'required|email|unique:teachers,email',
            'specialization' => 'nullable|string|max:100', // التخصص يمكن أن يكون فارغًا، ويجب أن يكون نصًا بأقصى طول 100
            'available_from' => 'nullable|date_format:H:i', // الوقت المتاح من بصيغة وقت (ساعة:دقيقة)
            'available_to' => 'nullable|date_format:H:i', // الوقت المتاح إلى بصيغة وقت
            'rate' => 'nullable|numeric|min:0', // يجب أن يكون الرقم موجبًا
            'notes' => 'nullable|string', // حقل الملاحظات يمكن أن يكون نصًا أو فارغًا
            'subject_id' => 'nullable|exists:subjects,id', // يجب أن يكون subject_id موجودًا في جدول المواد
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // التحقق من أن الملف صورة وأنواع الملفات المسموح بها وحجمها
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
