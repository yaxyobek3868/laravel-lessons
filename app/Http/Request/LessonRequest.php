<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LessonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'title'     => 'required|string|max:255',
            'content'   => 'required|string',
            'course_id' => 'required|exists:courses,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'     => 'Sarlavha bo‘sh bo‘masligi kerak',
            'title.string'       => 'Sarlavha matn bo‘lishi kerak',
            'title.max'          => 'Sarlavha 255 belgidan uzun bo‘lmasligi kerak',

            'content.required'   => 'Kontent bo‘sh bo‘masligi kerak',
            'content.string'     => 'Kontent matn bo‘lishi kerak',

            'course_id.required' => 'Kurs tanlanishi shart',
            'course_id.exists'   => 'Tanlangan kurs mavjud emas',
        ];
    }
}
