<?php

namespace App\Services;

class ResultsValidation extends CustomFormValidation
{
    private $results = [];

    // Тут указываем правильные ответы
    private const CORRECT_ANSWERS = [
        'question1' => ['AND', 'OR', 'NOT'],
        'question2' => 'intersection', // правильный ответ для combobox
        'question3' => '8',            // правильный ответ для текстового поля (число)
        // если добавишь RadioButton, можешь тут добавить его тоже
    ];

    public function checkResults($postArray)
    {
        foreach (self::CORRECT_ANSWERS as $question => $correctAnswer) {
            $userAnswer = $postArray[$question] ?? null;

            if ($question === 'question1') {
                // Для чекбоксов сравниваем массивы
                if (empty($userAnswer)) {
                    $this->results[$question] = 'Нет ответа';
                } elseif (is_array($userAnswer)) {
                    // ФИЛЬТРУЕМ пустые элементы!
                    $userAnswer = array_filter($userAnswer, fn($v) => !empty($v));

                    if (empty($userAnswer)) {
                        $this->results[$question] = 'Нет ответа';
                    } else {
                        // Сортируем для сравнения
                        sort($userAnswer);
                        $expected = self::CORRECT_ANSWERS['question1'];
                        sort($expected);

                        if ($userAnswer === $expected) {
                            $this->results[$question] = '✅ Верно';
                        } else {
                            $this->results[$question] = '❌ Неверно (вы выбрали: ' . implode(', ', $userAnswer) . ')';
                        }
                    }
                } else {
                    $this->results[$question] = 'Неверный формат ответа';
                }
            } else {
                // Для одиночных полей
                if ($userAnswer === null) {
                    $this->results[$question] = 'Нет ответа';
                } elseif ((string) $userAnswer === (string) $correctAnswer) {
                    $this->results[$question] = '✅ Верно';
                } else {
                    $this->results[$question] = '❌ Неверно (ваш ответ: ' . $userAnswer . ')';
                }
            }
        }
    }


    public function getResults()
    {
        return $this->results;
    }
}
