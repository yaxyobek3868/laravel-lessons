<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LessonRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check(); // auth()->user()->isAdmin() || auth()->user()->isTeacher();
    }

    public function rules()
    {
        return [
            'title'=>'required|string|max:255',
            'content'=>'required|string',
            'course_id'=>'required|exists:courses,id'
        ];
    }
}
