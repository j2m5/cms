<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendTicketRequest extends FormRequest
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
            'category_id' => 'required',
            'title' => 'required',
            'question' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Укажите категорию вопроса',
            'title.required' => 'Укажите тему вопроса',
            'question.required' => 'Вопрос не может быть пустым'
        ];
    }
}
