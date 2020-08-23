<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketMessageRequest extends FormRequest
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
            'message' => 'required|min:5|max:1000'
        ];
    }

    public function messages()
    {
        return [
            'message.required' => 'Сообщение не может быть пустым',
            'message.min' => 'Сообщение должно содержать не менее :min символа(ов)',
            'message.max' => 'Сообщение должно содержать не более :max символа(ов)',
        ];
    }
}
