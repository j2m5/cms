<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadAvatarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'avatar' => 'image|max:200'
        ];
    }

    public function messages()
    {
        return [
            'avatar.image' => 'Загружаемый файл должен быть изображением',
            'avatar.max' => 'Загружаемый файл не может быть более :max КБ'
        ];
    }
}
