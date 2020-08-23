<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuItemRequest extends FormRequest
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
            'label' => 'required|min:2',
            'url' => 'required|url|min:3',
        ];
    }

    public function messages()
    {
        return [
            'label.required' => 'Укажите название пункта меню',
            'label.min' => 'Название пункта меню должно содержать не менее :min символа(ов)',
            'url.required' => 'Укажите URL пункта меню',
            'url.url' => 'URL должен соответствовать URL-адресу (Например: http://example.com)',
            'url.min' => 'URL пункта меню должен содержать не менее :min символа(ов)'
        ];
    }
}
