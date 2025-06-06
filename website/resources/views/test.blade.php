@extends('layouts.app')

@section('title', 'Test')

@section('content')
{{--    @if (!session()->has('role'))--}}
{{--        <div id="accessModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">--}}
{{--            <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm text-center">--}}
{{--                <h3 class="text-lg font-semibold mb-4 text-red-600">Доступ ограничен</h3>--}}
{{--                <p class="text-gray-800 mb-6">Для просмотра результатов — зарегистрируйтесь или войдите в систему.</p>--}}
{{--                <a href="{{ route('login') }}"--}}
{{--                   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Войти</a>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <script>--}}
{{--            document.body.style.overflow = 'hidden';--}}
{{--        </script>--}}
{{--    @endif--}}

    <h2 class="text-3xl font-semibold mb-6">Input data and answer the question</h2>

    @if ($errors->any())
        <x-alert type="error" :messages="$errors->all()" />
    @endif

    @if (session('success'))
        <x-alert type="success" :messages="session('success')" :timeout="3000" />
    @endif

    @if (session('results'))
        @if (!session()->has('role'))
            <div id="accessModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
                <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm text-center relative animate-fade-in">
                    <button onclick="closeAccessModal()"
                            class="absolute top-2 right-2 text-gray-500 hover:text-red-600 text-2xl font-bold">&times;</button>

                    <h3 class="text-lg font-semibold mb-4 text-red-600">Доступ ограничен</h3>
                    <p class="text-gray-800 mb-6">Для просмотра результатов — зарегистрируйтесь или войдите в систему.</p>
                    <a href="{{ route('login') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Войти</a>
                </div>
            </div>
            <script>
                document.body.style.overflow = 'hidden';
                function closeAccessModal() {
                    const modal = document.getElementById('accessModal');
                    modal.style.opacity = '0';
                    modal.style.pointerEvents = 'none';
                    document.body.style.overflow = 'auto';
                    setTimeout(() => modal.remove(), 300);
                }
            </script>
            <style>
                @keyframes fade-in {
                    from { opacity: 0; transform: scale(0.95); }
                    to { opacity: 1; transform: scale(1); }
                }
                .animate-fade-in {
                    animation: fade-in 0.3s ease-out forwards;
                }
            </style>
        @else
        <div id="resultsBlock" class="bg-gray-700 text-white p-4 rounded-lg mt-4 mb-6 relative max-w-4xl mx-auto transition-opacity duration-500 ease-in-out">
            <button onclick="closeResults()"
                    class="absolute top-2 right-2 text-white hover:text-red-400 font-bold text-xl leading-none">&times;</button>
            <h3 class="text-lg font-semibold mb-2">Результаты проверки:</h3>
            <ul class="list-disc pl-6">
                @foreach (session('results') as $question => $result)
                    <li><strong>{{ ucfirst($question) }}:</strong> {{ $result }}</li>
                @endforeach
            </ul>
            <a href="{{ route('test.results') }}" class="inline-block mt-4 text-blue-400 hover:underline">Посмотреть все результаты</a>
        </div>

        <script>
            function closeResults() {
                const block = document.getElementById('resultsBlock');
                block.style.opacity = '0';
                setTimeout(() => { block.style.display = 'none'; }, 500);
            }
            setTimeout(closeResults, 5000);
        </script>
        @endif
    @endif

    <form action="{{ route('test.submit') }}" method="POST" class="max-w-4xl mx-auto p-6 bg-gray-800 rounded-lg shadow-lg">
        @csrf

        <fieldset class="mb-6">
            <legend class="text-2xl font-semibold text-white mb-4">User's data</legend>

            <x-form.input name="fullname" fieldLabel="FIO:" class="mb-4" />

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
                <label class="text-lg text-white block mb-2">1. Какие из этих элементов являются булевыми операциями?</label>
                <div class="flex space-x-16">
                    <div class="flex items-center">
                        <x-form.input type="checkbox" name="question1[]" id="and" value="AND" class="mr-2" />
                        <label for="and" class="text-white">AND (И)</label>
                    </div>
                    <div class="flex items-center">
                        <x-form.input type="checkbox" name="question1[]" id="or" value="OR" class="mr-2" />
                        <label for="or" class="text-white">OR (ИЛИ)</label>
                    </div>
                    <div class="flex items-center">
                        <x-form.input type="checkbox" name="question1[]" id="not" value="NOT" class="mr-2" />
                        <label for="not" class="text-white">NOT (НЕ)</label>
                    </div>
                    <div class="flex items-center">
                        <x-form.input type="checkbox" name="question1[]" id="sum" value="SUM" class="mr-2" />
                        <label for="sum" class="text-white">Суммирование</label>
                    </div>
                </div>
            </div>

            <x-form.select name="question2" fieldLabel="2. Операция с множествами" :options="[
            'union' => 'Объединение',
            'intersection' => 'Пересечение',
            'difference' => 'Разность',
            'symmetric_difference' => 'Симметрическая разность',
        ]" class="mb-4" />

            <x-form.input name="question3" fieldLabel="3. Строк в таблице истинности для 3 переменных" type="number" min="1" max="100" class="mb-4" />
        </fieldset>

        <div class="form-buttons flex justify-between">
            <x-form.button type="submit" fieldLabel="Send" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-md shadow-md" />
            <x-form.button type="reset" fieldLabel="Clear form" class="bg-gray-600 hover:bg-gray-700 text-white py-2 px-6 rounded-md shadow-md" />
        </div>
    </form>
@endsection
