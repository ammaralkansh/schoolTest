<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentsRequest extends FormRequest
{
    public function authorize()
    {
        return backpack_auth()->check();
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'country' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:students,email', // Ensure email is unique
            'date_of_birth' => 'required|date',
            'classroom_id' => 'required|exists:classrooms,id',
            'status' => 'required|string',
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'البريد الإلكتروني', // Customize attribute name
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'يرجى إدخال البريد الإلكتروني.',
            'email.email' => 'يرجى إدخال بريد إلكتروني صحيح.',
            'email.unique' => 'هذا البريد الإلكتروني مستخدم بالفعل.',
        ];
    }
}
