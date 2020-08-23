<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostRequest extends FormRequest
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
            'slug' => 'max:255|unique:blog_posts,slug,'.$this->route('id'),
            'category_id' => 'required|integer|min:1',
            'excerpt' => 'required|string|min:2',
            'content' => 'required|string|min:2',
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
            'category_id.required' => 'Укажите раздел',
            'category_id.min' => 'Укажите раздел',
            'excerpt.required' => 'Превью не может быть пустым',
            'excerpt.min' => 'Слишком короткое превью (минимум :min символа(ов))',
            'content.required' => 'Запись не может быть пустой',
            'content.min' => 'Слишком короткая запись (минимум :min символа(ов))',
            'md.max' => 'Слишком длинное мета-описание (максимум :max символа(ов))',
            'mk.max' => 'Слишком длинные ключевые слова (максимум :max символа(ов))'
        ];
    }
}
