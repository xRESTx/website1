<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CustomFormValidation;
use App\Services\ResultsValidation;

class TestFormController extends Controller
{
    public function show()
    {
        return view('test');
    }

    public function submit(Request $request)
    {
        $validator = new ResultsValidation();

        // 1️⃣ Выполняем стандартную валидацию
        $validator->validate($request->all());

        if ($errors = $validator->getErrors()) {
            return back()->withErrors($errors)->withInput();
        }

        // 2️⃣ Проверяем правильность ответов
        $validator->checkResults($request->all());

        // 3️⃣ Передаём результаты обратно во View
        return back()->with('success', 'Тест успешно отправлен!')
            ->with('results', $validator->getResults());
    }
}
