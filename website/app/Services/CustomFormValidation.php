<?php

namespace App\Services;

class CustomFormValidation extends FormValidation
{
    public function __construct()
    {
        // Основные правила
        $this->setRule('fullname', 'isNotEmpty');
        $this->setRule('group', 'isNotEmpty');
        $this->setRule('question2', 'isNotEmpty');
        $this->setRule('question3', 'isNotEmpty');
        $this->setRule('question3', 'isInteger');
        $this->setRule('question3', 'isEqual', 8); // специальная проверка: должно быть 8 строк
    }

    // Добавляем метод проверки "isEqual"
    protected  function isEqual($data, $expected)
    {
        if ($data != $expected) {
            return "Значение должно быть равно $expected.";
        }
        return null;
    }

    // Переопределим validate, чтобы добавить кастомную логику для question1 (массив чекбоксов)
    public function validate($postArray)
    {
        parent::validate($postArray);

        // Проверка: хотя бы один чекбокс выбран
        if (empty($postArray['question1']) || !is_array($postArray['question1'])) {
            $this->errors['question1'][] = "Выберите хотя бы один вариант в вопросе 1.";
        }
    }
}
