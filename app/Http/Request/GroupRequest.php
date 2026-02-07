<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class GroupRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'name'       => 'required|string|max:255',
            'course_id'  => 'required|exists:courses,id',
            'teacher_id' => 'required|exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required'       => 'Guruh nomi bo‘sh bo‘lishi mumkin emas',
            'name.string'         => 'Guruh nomi matn bo‘lishi kerak',
            'name.max'            => 'Guruh nomi 255 belgidan ko‘p bo‘lmasligi kerak',

            'course_id.required'  => 'Kurs tanlanishi shart',
            'course_id.exists'    => 'Tanlangan kurs mavjud emas',

            'teacher_id.required' => 'O‘qituvchi tanlanishi shart',
            'teacher_id.exists'   => 'Tanlangan o‘qituvchi mavjud emas',
        ];
    }
}
