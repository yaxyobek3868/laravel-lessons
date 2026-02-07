<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        $userId = $this->route('user')?->id ?? null;

        return [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'phone' => 'required',
            'address' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'password' => $this->isMethod('post') ? 'required|string|min:3' : 'nullable|string|min:3',
            'role' => 'required|numeric|in:1,2,3',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'Ism bo‘sh bo‘masligi kerak',
            'email.required'    => 'Email bo‘sh bo‘masligi kerak',
            'email.email'       => 'To‘g‘ri email manzili kiriting',
            'password.required' => 'Parol bo‘sh bo‘masligi kerak',
            'password.min'      => 'Parol kamida 3 ta belgidan iborat bo‘lishi kerak',
            'role.required'     => 'Rol tanlanishi shart',
            'username.required' => 'Foydalanuvchi nomi bo‘sh bo‘masligi kerak',
        ];
    }


}
