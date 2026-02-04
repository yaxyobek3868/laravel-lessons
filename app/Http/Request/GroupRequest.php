<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class GroupRequest extends FormRequest
{
    public function authorize() 
    {
        return Auth::check(); // auth()->user()->isAdmin() || auth()->user()->isTeacher();
    }

    public function rules()
    {
        return [
            'name'=>'required|string|max:255',
            'course_id'=>'required|exists:courses,id',
            'teacher_id'=>'required|exists:users,id'
        ];
    }
}
