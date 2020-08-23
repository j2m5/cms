<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content' => 'required|min:2|max:1000'
        ];
    }

    public function messages()
    {
        return [
            'content.required' => 'Комментарий не может быть пустым',
            'content.min' => 'Слишком короткий комментарий (минимум :min символа(ов))',
            'content.max' => 'Слишком длинный комментарий (максимум :max символа(ов))'
        ];
    }
}
