@extends('layouts.app')

@section('title', 'Test')

@section('content')
    <h2 class="text-3xl font-semibold mb-6">Input data and answer the question</h2>
    @if ($errors->any())
        <x-alert type="error" :messages="$errors->all()" />
    @endif

    @if (session('success'))
        <x-alert type="success" :messages="session('success')" :timeout="3000" />
    @endif

    @if (session('results'))
        <div class="bg-gray-700 text-white p-4 rounded-lg mt-4">
            <h3 class="text-lg font-semibold mb-2">Результаты проверки:</h3>
            <ul class="list-disc pl-6">
                @foreach (session('results') as $question => $result)
                    <li><strong>{{ ucfirst($question) }}:</strong> {{ $result }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('test.submit') }}" method="POST" class="max-w-4xl mx-auto p-6 bg-gray-800 rounded-lg shadow-lg">
        @csrf

        <fieldset class="mb-6">
            <legend class="text-2xl font-semibold text-white mb-4">User's data</legend>

            <x-form.input name="fullname" fieldLabel="FIO:"  class="mb-4" />

            <x-form.select name="group" :field-label="'Group'"
                           :options="[
                    '1 курс' => [
                        'IT/b-24-1' => 'IT/b-24-1',
                        'IT/b-24-2' => 'IT/b-24-2',
                    ],
                    '3 курс' => [
                        'IS/b-22-1' => 'IS/b-22-1',
                        'IS/b-22-2' => 'IS/b-22-2',
                    ]
                ]" class="mb-4" />
        </fieldset>

        <fieldset class="mb-6">
            <legend class="text-2xl font-semibold text-white mb-4">Questions</legend>

            <div class="form-group mb-4">
                <label class="text-lg text-white">1. Какие из этих элементов являются булевыми операциями?</label>
                <div class="flex items-center space-x-32 mt-2">
                    <div class="flex items-center">
                        <x-form.input type="checkbox" name="question1[]" id="and" value="AND" class="mr-2 mt-5" />
                        <label for="and" class="text-white align-middle">AND (И)</label>
                    </div>
                    <div class="flex items-center">
                        <x-form.input type="checkbox" name="question1[]" id="or" value="OR" class="mr-2 mt-5" />
                        <label for="or" class="text-white align-middle">OR (ИЛИ)</label>
                    </div>
                    <div class="flex items-center">
                        <x-form.input type="checkbox" name="question1[]" id="not" value="NOT" class="mr-2 mt-5" />
                        <label for="not" class="text-white align-middle">NOT (НЕ)</label>
                    </div>
                    <div class="flex items-center">
                        <x-form.input type="checkbox" name="question1[]" id="sum" value="SUM" class="mr-2 mt-5" />
                        <label for="sum" class="text-white align-middle">Суммирование</label>
                    </div>
                </div>
            </div>

            <x-form.select name="question2" fieldLabel="2. Операция с множествами"  :options="[
                'union' => 'Объединение',
                'intersection' => 'Пересечение',
                'difference' => 'Разность',
                'symmetric_difference' => 'Симметрическая разность',
            ]" class="mb-4" />

            <x-form.input name="question3" fieldLabel="3. Строк в таблице истинности для 3 переменных" type="number" min="1" max="100"  class="mb-4" />
        </fieldset>

        <div class="form-buttons flex justify-between">
            <x-form.button type="submit" fieldLabel="Send" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-md shadow-md" />
            <x-form.button type="reset" fieldLabel="Clear form" class="bg-gray-600 hover:bg-gray-700 text-white py-2 px-6 rounded-md shadow-md" />
        </div>
    </form>
@endsection
