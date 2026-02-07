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
            'title'=>'required|string|max:255',
            'content'=>'required|string',
            'course_id'=>'required|exists:courses,id'
        ];
    }
}
