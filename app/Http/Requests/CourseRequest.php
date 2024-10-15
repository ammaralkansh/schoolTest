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
        'name' => 'required|min:5|max:255',
        'subject_id' => 'required|exists:subjects,id',
        'teacher_id' => 'required|exists:teachers,id',
        'organizer_id' => 'required|exists:staff,id',
        'level' => 'required',
        'stage' => 'required',
        'duration' => 'required|integer|min:1',
        'min_students' => 'required|integer|min:1',
        'max_students' => 'required|integer|min:1|gte:min_students',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'course_type' => 'required',
        'number_of_lessons' => 'required|integer|min:1',
        'status' => 'required',
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
