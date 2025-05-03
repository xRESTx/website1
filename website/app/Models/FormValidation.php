<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormValidation
{
    // Массив правил валидации
    private $rules = [];
    // Массив ошибок
    private $errors = [];

    // Метод проверки на пустоту
    private function isNotEmpty($data)
    {
        if (empty($data)) {
            return "Это поле не может быть пустым.";
        }
        return null;
    }

    // Метод проверки на целое число
    private function isInteger($data)
    {
        if (!filter_var($data, FILTER_VALIDATE_INT)) {
            return "Значение должно быть целым числом.";
        }
        return null;
    }

    // Метод проверки на меньшее значение
    private function isLess($data, $value)
    {
        if (!filter_var($data, FILTER_VALIDATE_INT)) {
            return "Значение должно быть целым числом.";
        }
        if ($data < $value) {
            return "Значение должно быть не меньше чем $value.";
        }
        return null;
    }

    // Метод проверки на большее значение
    private function isGreater($data, $value)
    {
        if (!filter_var($data, FILTER_VALIDATE_INT)) {
            return "Значение должно быть целым числом.";
        }
        if ($data > $value) {
            return "Значение должно быть не больше чем $value.";
        }
        return null;
    }

    // Метод проверки на email
    private function isEmail($data)
    {
        if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
            return "Значение должно быть действительным email.";
        }
        return null;
    }

    // Метод для добавления правила
    public function setRule($fieldName, $validatorName, $value = null)
    {
        $this->rules[$fieldName][] = ['validator' => $validatorName, 'value' => $value];
    }

    // Метод для выполнения валидации
    public function validate($postArray)
    {
        $this->errors = []; // очищаем ошибки

        foreach ($this->rules as $field => $validators) {
            if (isset($postArray[$field])) {
                foreach ($validators as $validator) {
                    $validatorName = $validator['validator'];
                    $value = $validator['value'];
                    $data = $postArray[$field];

                    // Вызываем соответствующий метод в зависимости от типа валидатора
                    $errorMessage = null;
                    if (method_exists($this, $validatorName)) {
                        if ($value !== null) {
                            $errorMessage = $this->$validatorName($data, $value);
                        } else {
                            $errorMessage = $this->$validatorName($data);
                        }
                    }

                    // Если есть ошибка, добавляем её в массив ошибок
                    if ($errorMessage) {
                        $this->errors[$field][] = $errorMessage;
                    }
                }
            }
        }
    }

    // Метод для вывода ошибок
    public function showErrors()
    {
        if (empty($this->errors)) {
            return null;
        }

        $html = "<ul>";
        foreach ($this->errors as $field => $messages) {
            foreach ($messages as $message) {
                $html .= "<li><strong>$field:</strong> $message</li>";
            }
        }
        $html .= "</ul>";

        return $html;
    }

    // Метод для получения ошибок
    public function getErrors()
    {
        return $this->errors;
    }
}
