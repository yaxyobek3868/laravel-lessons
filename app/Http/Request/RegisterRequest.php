<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
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
            'name.required' => 'Iltimos, ismingizni kiriting.',
            'name.string' => 'Ism matn bo‘lishi kerak.',
            'name.max' => 'Ism 255 belgidan oshmasligi kerak.',

            'username.required' => 'Iltimos, foydalanuvchi nomini kiriting.',
            'username.string' => 'Foydalanuvchi nomi matn bo‘lishi kerak.',
            'username.max' => 'Foydalanuvchi nomi 50 belgidan oshmasligi kerak.',
            'username.unique' => 'Bu foydalanuvchi nomi allaqachon ishlatilgan.',

            'email.required' => 'Iltimos, elektron pochtangizni kiriting.',
            'email.email' => 'Iltimos, haqiqiy email kiriting.',
            'email.max' => 'Email 255 belgidan oshmasligi kerak.',
            'email.unique' => 'Bu email allaqachon ishlatilgan.',

            'password.required' => 'Iltimos, parolni kiriting.',
            'password.string' => 'Parol matn bo‘lishi kerak.',
            'password.min' => 'Parol kamida 6 ta belgidan iborat bo‘lishi kerak.',
            'password.confirmed' => 'Parol tasdiqlanishi noto‘g‘ri.',
        ];
    }
}
