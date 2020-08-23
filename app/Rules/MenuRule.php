<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;

class MenuRule implements Rule
{
    private $data;
    private $errors = [];
    private $minLength = 2;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function passes($attribute, $value)
    {
        return $this->validateData($this->data);
    }

    public function message()
    {
        return $this->errors;
    }

    private function validateData($data)
    {
        if (!count($data)) return true;
        else {
            foreach ($data as $item) {
                if (empty($item['label'])) {
                    $this->errors = Arr::add($this->errors, 'labelRequired', 'Укажите название пункта меню');
                }
                if (strlen($item['label']) < $this->minLength) {
                    $this->errors = Arr::add($this->errors, 'labelMin', 'Название пункта меню должно содержать не менее '.$this->minLength.' символа(ов)');
                }
                if (empty($item['url'])) {
                    $this->errors = Arr::add($this->errors, 'UrlRequired', 'Укажите URL пункта меню');
                }
                if (strlen($item['url']) < $this->minLength) {
                    $this->errors = Arr::add($this->errors, 'UrlMin', 'URL пункта меню должен содержать не менее '.$this->minLength.' символа(ов)');
                }
                if (!preg_match('/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/', $item['url'])) {
                    $this->errors = Arr::add($this->errors, 'UrlRequired', 'URL должен соответствовать URL-адресу (Например: http://example.com)');
                }
                if (count($item['items'])) $this->validateData($item['items']);
            }
        }
        if (count($this->errors)) return false;
        return true;
    }
}
