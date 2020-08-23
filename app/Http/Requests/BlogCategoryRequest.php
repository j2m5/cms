<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogCategoryRequest extends FormRequest
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
            'title' => 'required|string|min:2|max:255',
            'slug' => 'max:255|unique:blog_categories,slug,'.$this->route('id'),
            'parent_id' => 'required',
            'description' => 'max:255',
            'md' => 'max:255',
            'mk' => 'max:255',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Укажите название',
            'title.min' => 'Слишком короткое название (минимум :min символа(ов))',
            'title.max' => 'Слишком длинное название (максимум :max символа(ов))',
            'slug.max' => 'Слишком длинный ярлык (максимум :max символа(ов))',
            'slug.unique' => 'Такой ярлык уже существует',
            'parent_id.required' => 'Укажите раздел',
            'description.max' => 'Слишком длинное описание (максимум :max символа(ов))',
            'md.max' => 'Слишком длинное мета-описание (максимум :max символа(ов))',
            'mk.max' => 'Слишком длинные ключевые слова (максимум :max символа(ов))'
        ];
    }
}
