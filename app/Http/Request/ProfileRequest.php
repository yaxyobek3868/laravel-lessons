<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
  
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "user_id"=> "required|exists:users,id",
            "phone"=> "require|string|max:255",
            'adress' => "require|string|max:255",
        ];
    }
}
