<?php

namespace App\Http\Requests;


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
}
