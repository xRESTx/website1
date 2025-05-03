@extends('layouts.app')

@section('title', 'Education')

@section('content')
    <section id="university" class="space-y-4">
        <h2 class="section-title">University and Institute</h2>
        <p class="section-text"><strong>University:</strong> SevSU</p>
        <p class="section-text"><strong>Institute:</strong> IT</p>
    </section>

    <section id="notEndedTest" class="space-y-4 mt-8">
        <h2 class="section-title">Not Ended Tests</h2>
        <ul class="list-disc pl-6 text-gray-300">
            <li>Основы дискретной математики - <a href="{{ url('/test') }}" class="test-link">Пройти тест</a></li>
        </ul>
    </section>

    <section id="disciplines" class="mt-8">
        <h2 class="section-title mb-6">List of Disciplines (Semesters 1–4)</h2>
        <table class="table-auto w-full border border-gray-600 text-sm text-left text-gray-300">
            <thead class="bg-gray-700 text-gray-400">
            <tr>
                <th class="px-2 py-1">№</th>
                <th class="px-2 py-1">Дисциплина</th>
                <th class="px-2 py-1">Кафедра</th>
                <th class="px-2 py-1">Всего</th>
                <th class="px-2 py-1">Ауд</th>
                <th class="px-2 py-1">Лк</th>
                <th class="px-2 py-1">Лб</th>
                <th class="px-2 py-1">Пр</th>
                <th class="px-2 py-1">СРС</th>
            </tr>
            </thead>
            <tbody>
            <!-- Здесь идут строки -->
            <tr class="table-row">
                <td class="table-cell">1</td>
                <td class="table-cell">Экология</td>
                <td class="table-cell">БЖ</td>
                <td class="table-cell">54</td>
                <td class="table-cell">27</td>
                <td class="table-cell">18</td>
                <td class="table-cell">0</td>
                <td class="table-cell">9</td>
                <td class="table-cell">27</td>
            </tr>
            <tr class="table-row">
                <td class="table-cell">2</td>
                <td class="table-cell">Высшая математика</td>
                <td class="table-cell">ВМ</td>
                <td class="table-cell">540</td>
                <td class="table-cell">324</td>
                <td class="table-cell">162</td>
                <td class="table-cell">54</td>
                <td class="table-cell">108</td>
                <td class="table-cell">216</td>
            </tr>
            <tr class="table-row">
                <td class="table-cell">3</td>
                <td class="table-cell">Русский язык и культура речи</td>
                <td class="table-cell">НГП</td>
                <td class="table-cell">108</td>
                <td class="table-cell">54</td>
                <td class="table-cell">27</td>
                <td class="table-cell">0</td>
                <td class="table-cell">27</td>
                <td class="table-cell">54</td>
            </tr>
            <tr class="table-row">
                <td class="table-cell">4</td>
                <td class="table-cell">Основы дискретной математики</td>
                <td class="table-cell">ИС</td>
                <td class="table-cell">162</td>
                <td class="table-cell">108</td>
                <td class="table-cell">54</td>
                <td class="table-cell">18</td>
                <td class="table-cell">36</td>
                <td class="table-cell">54</td>
            </tr>
            <tr class="table-row">
                <td class="table-cell">5</td>
                <td class="table-cell">Основы программирования и алгоритмические языки</td>
                <td class="table-cell">ИС</td>
                <td class="table-cell">405</td>
                <td class="table-cell">270</td>
                <td class="table-cell">135</td>
                <td class="table-cell">90</td>
                <td class="table-cell">45</td>
                <td class="table-cell">135</td>
            </tr>
            <tr class="table-row">
                <td class="table-cell">6</td>
                <td class="table-cell">Основы экологии</td>
                <td class="table-cell">ПЭЭОП</td>
                <td class="table-cell">54</td>
                <td class="table-cell">27</td>
                <td class="table-cell">18</td>
                <td class="table-cell">0</td>
                <td class="table-cell">9</td>
                <td class="table-cell">27</td>
            </tr>
            <tr class="table-row">
                <td class="table-cell">7</td>
                <td class="table-cell">Теория вероятностей и мат. статистика</td>
                <td class="table-cell">ИС</td>
                <td class="table-cell">216</td>
                <td class="table-cell">108</td>
                <td class="table-cell">54</td>
                <td class="table-cell">18</td>
                <td class="table-cell">36</td>
                <td class="table-cell">108</td>
            </tr>
            <tr class="table-row">
                <td class="table-cell">8</td>
                <td class="table-cell">Физика</td>
                <td class="table-cell">Физики</td>
                <td class="table-cell">324</td>
                <td class="table-cell">162</td>
                <td class="table-cell">108</td>
                <td class="table-cell">36</td>
                <td class="table-cell">18</td>
                <td class="table-cell">162</td>
            </tr>
            <tr class="table-row">
                <td class="table-cell">9</td>
                <td class="table-cell">Основы электротехники и электроники</td>
                <td class="table-cell">ИС</td>
                <td class="table-cell">216</td>
                <td class="table-cell">108</td>
                <td class="table-cell">54</td>
                <td class="table-cell">18</td>
                <td class="table-cell">36</td>
                <td class="table-cell">108</td>
            </tr>
            <tr class="table-row">
                <td class="table-cell">10</td>
                <td class="table-cell">Численные методы в информатике</td>
                <td class="table-cell">ИС</td>
                <td class="table-cell">189</td>
                <td class="table-cell">108</td>
                <td class="table-cell">54</td>
                <td class="table-cell">36</td>
                <td class="table-cell">18</td>
                <td class="table-cell">81</td>
            </tr>
            <tr class="table-row">
                <td class="table-cell">11</td>
                <td class="table-cell">Методы исследования операций</td>
                <td class="table-cell">ИС</td>
                <td class="table-cell">216</td>
                <td class="table-cell">104</td>
                <td class="table-cell">52</td>
                <td class="table-cell">17</td>
                <td class="table-cell">35</td>
                <td class="table-cell">112</td>
            </tr>
            </tbody>
        </table>
    </section>
@endsection
