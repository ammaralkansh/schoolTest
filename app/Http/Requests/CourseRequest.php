<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'organizer_id' => 'required|exists:organizers,id', // تأكد من وجود هذا السطر
            'level' => 'required|string',
            'stage' => 'required|string',
            'duration' => 'required|integer',
            'min_students' => 'required|integer',
            'max_students' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'course_type' => 'required|string',
            'number_of_lessons' => 'required|integer',
            'status' => 'required|string',
            'whatsapp_group' => 'boolean',
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
