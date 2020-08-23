<?php

namespace App\Http\Requests;

use App\Rules\MenuRule;
use Illuminate\Foundation\Http\FormRequest;

class MenuUpdateRequest extends FormRequest
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
            'name' => 'required|min:3',
            'items' => ['array', new MenuRule($this->input('items'))]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Укажите название меню',
            'name.min' => 'Название меню должно содержать не менее :min символа(ов)'
        ];
    }
}
