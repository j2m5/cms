<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
            'name' => 'required|min:2|max:20'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Укажите название',
            'name.min' => 'Слишком короткое название (минимум :min символа(ов))',
            'name.max' => 'Слишком длинное название (максимум :max символа(ов))'
        ];
    }
}
