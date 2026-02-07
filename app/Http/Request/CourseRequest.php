<?php

namespace App\Http\Request;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CourseRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'title'=>'required|string|max:255',
            'description'=>'nullable|string',
            'teacher_id'=>'required|exists:users,id'
        ];
    }
    public function messages(): array
    {
        return [
            'title.required'       => 'Sarlavha bo‘sh bo‘lmasligi kerak',
            'description.required' => 'Tavsif bo‘sh bo‘lmasligi kerak',
            'teacher_id.required'  => 'O‘qituvchi tanlanishi shart',
        ];
    }

}
