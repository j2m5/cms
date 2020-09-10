<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'login' => 'required|string|min:2|max:255|unique:users,login,'.$this->route('id'),
            'email' => 'required|string|email|min:6|max:255|unique:users,email,'.$this->route('id'),
            'password' => 'nullable|string|min:3|max:255',
        ];
    }

    public function messages()
    {
        return [
            'login.required' => 'Укажите логин',
            'login.min' => 'Слишком короткий логин (минимум :min символа(ов))',
            'login.max' => 'Слишком длинный логин (максимум :max символа(ов))',
            'login.unique' => 'Указанный логин уже существует',
            'email.required' => 'Укажите E-mail',
            'email.email' => 'E-mail должен быть валидным адресом',
            'email.min' => 'Слишком короткий E-mail (минимум :min символа(ов))',
            'email.max' => 'Слишком длинный E-mail (максимум :max символа(ов))',
            'email.unique' => 'Указанный E-mail уже существует',
            'password.required' => 'Укажите пароль',
            'password.min' => 'Слишком короткий пароль (минимум :min символа(ов))',
            'password.max' => 'Слишком длинный пароль (максимум :max символа(ов))'
        ];
    }
}
