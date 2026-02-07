<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ];
    }

    /**
     * Custom error messages for validation
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'username.required' => 'Iltimos, foydalanuvchi nomini kiriting.',
            'username.string' => 'Foydalanuvchi nomi matn bo‘lishi kerak.',
            'username.max' => 'Foydalanuvchi nomi 255 belgidan oshmasligi kerak.',
            'password.required' => 'Iltimos, parolni kiriting.',
            'password.string' => 'Parol matn bo‘lishi kerak.',
            'password.min' => 'Parol kamida 6 ta belgidan iborat bo‘lishi kerak.',
        ];
    }
}
