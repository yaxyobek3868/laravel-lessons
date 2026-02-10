<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
{
    public function authorize(): bool
    {
        
        return true;
    }

    public function rules(): array
    {
        return [
            'title'    => 'required|string|max:255',
            'content'  => 'required|string',
            'group_id' => 'required|exists:groups,id',
            'file'     => 'nullable|file|mimes:pdf,doc,docx,txt,jpg', 
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'    => 'Sarlavha bo‘sh bo‘lmasligi kerak',
            'content.required'  => 'Kontent bo‘sh bo‘lmasligi kerak',
            'group_id.required' => 'Guruh tanlanishi shart',
            'group_id.exists'   => 'Tanlangan guruh mavjud emas',
            'file.mimes'        => 'Fayl faqat PDF, DOC, DOCX yoki TXT formatida bo‘lishi mumkin',
        ];
    }
}
