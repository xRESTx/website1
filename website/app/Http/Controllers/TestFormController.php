<?php

namespace App\Http\Controllers;

use App\Models\TestResult;
use Illuminate\Http\Request;
use App\Services\CustomFormValidation;
use App\Services\ResultsValidation;

class TestFormController extends Controller {
    public function show() {
        return view('test');
    }

    public function submit(Request $request) {
        $validator = new ResultsValidation();
        $validator->validate($request->all());

        if ($errors = $validator->getErrors()) {
            return back()->withErrors($errors)->withInput();
        }

        $validator->checkResults($request->all());

        $userAnswers = [
            'question1' => $request->input('question1', []),
            'question2' => $request->input('question2'),
            'question3' => (int) $request->input('question3'),
        ];

        $results = $validator->getResults();

        TestResult::create([
            'fullname' => $request->input('fullname'),
            'group'    => $request->input('group'),
            'answers'  => $userAnswers,
            'results'  => $results,
        ]);

        return back()->with('success', 'Тест успешно отправлен!')
            ->with('results', $results);
    }
    public function showResults() {
        $results = TestResult::latest()->get();
        return view('testResults', compact('results'));
    }
}
