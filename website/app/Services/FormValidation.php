<?php


namespace App\Services;

class FormValidation
{
    private $rules = [];
    private $errors = [];

    protected function isNotEmpty($data)
    {
        if (empty($data)) {
            return "Это поле не может быть пустым.";
        }
        return null;
    }

    protected function isInteger($data)
    {
        if (!filter_var($data, FILTER_VALIDATE_INT)) {
            return "Значение должно быть целым числом.";
        }
        return null;
    }

    protected function isLess($data, $value)
    {
        if (!filter_var($data, FILTER_VALIDATE_INT)) {
            return "Значение должно быть целым числом.";
        }
        if ($data < $value) {
            return "Значение должно быть не меньше чем $value.";
        }
        return null;
    }

    protected function isGreater($data, $value)
    {
        if (!filter_var($data, FILTER_VALIDATE_INT)) {
            return "Значение должно быть целым числом.";
        }
        if ($data > $value) {
            return "Значение должно быть не больше чем $value.";
        }
        return null;
    }

    protected function isEmail($data)
    {
        if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
            return "Введите корректный email.";
        }
        return null;
    }

    public function setRule($fieldName, $validatorName, $value = null)
    {
        $this->rules[$fieldName][] = ['validator' => $validatorName, 'value' => $value];
    }

    public function validate($postArray)
    {
        $this->errors = [];

        foreach ($this->rules as $field => $validators) {
            if (isset($postArray[$field])) {
                foreach ($validators as $validator) {
                    $validatorName = $validator['validator'];
                    $value = $validator['value'];
                    $data = $postArray[$field];

                    $errorMessage = null;
                    if (method_exists($this, $validatorName)) {
                        if ($value !== null) {
                            $errorMessage = $this->$validatorName($data, $value);
                        } else {
                            $errorMessage = $this->$validatorName($data);
                        }
                    }

                    if ($errorMessage) {
                        $this->errors[$field][] = $errorMessage;
                    }
                }
            } else {
                // если поле вообще не передано
                $this->errors[$field][] = "Поле '$field' не заполнено.";
            }
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
