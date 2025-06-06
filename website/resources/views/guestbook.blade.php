@extends('layouts.app')

@section('title', 'Guestbook')

@section('content')
    <h2 class="text-2xl font-bold text-white mb-4">Гостевая книга</h2>

    @if(session('success'))
        <x-alert type="success" :messages="session('success')" />
    @endif

    {{-- Блок доступный для всех пользователей --}}
    @if(session()->has('role'))
        {{-- Кнопка раскрытия формы --}}
        <div id="toggleSection" onclick="toggleForm()"
             class="mb-4 bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded flex items-center justify-between cursor-pointer select-none"
             style="width: 180px;">
            <span>Написать отзыв</span>
            <svg id="arrowIcon" class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>

        {{-- Форма отзыва --}}
        <form id="guestbookForm" action="{{ route('guestbook.submit') }}" method="POST"
              class="hidden mb-8 space-y-4 bg-gray-800 p-6 rounded max-w-2xl mx-auto mt-16">
            @csrf
            <x-form.input name="lastname" fieldLabel="Фамилия" required />
            <x-form.input name="firstname" fieldLabel="Имя" required />
            <x-form.input name="middlename" fieldLabel="Отчество" />
            <x-form.input name="email" fieldLabel="E-mail" type="email" required />
            <x-form.textarea name="message" fieldLabel="Текст отзыва" required />

            {{-- Фейковая капча --}}
            <div class="flex items-center space-x-2 cursor-pointer select-none" onclick="startFakeCaptchaCheck()" style="user-select:none;">
                <div id="fakeCaptchaCheckbox" class="w-6 h-6 border-2 border-gray-300 rounded flex items-center justify-center bg-white relative overflow-hidden"></div>
                <label class="text-white select-none">Я не робот</label>
            </div>

            <x-form.button type="submit" fieldLabel="Отправить отзыв"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded" />
        </form>
    @endif

    {{-- Админская часть: только для роли "admin" --}}
    @if(session('role') === 'admin')
        <form action="{{ route('guestbook.import') }}" method="POST" enctype="multipart/form-data" class="mb-6 bg-gray-800 p-4 rounded">
            @csrf
            <div class="flex items-center space-x-4">
                <input type="file" name="import_file" required
                       class="bg-gray-700 text-white border border-gray-600 rounded p-2" />
                <x-form.button type="submit" fieldLabel="Импортировать отзывы"
                               class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded" />
            </div>
        </form>
    @endif

    {{-- Общая часть: таблица отзывов --}}
    <h3 class="text-xl text-white font-semibold mb-2">Отзывы пользователей:</h3>
    <table class="w-full bg-gray-700 text-white rounded overflow-hidden">
        <thead class="bg-gray-600">
        <tr>
            <th class="p-2">Дата</th>
            <th class="p-2">ФИО</th>
            <th class="p-2">E-mail</th>
            <th class="p-2">Отзыв</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($messages as $msg)
            <tr class="border-t border-gray-600">
                <td class="p-2">{{ $msg['date'] }}</td>
                <td class="p-2">{{ $msg['fio'] }}</td>
                <td class="p-2">{{ $msg['email'] }}</td>
                <td class="p-2">{{ $msg['text'] }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="p-4 text-center">Пока отзывов нет</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{-- Стили и скрипты остаются без изменений --}}
    <style>
        @keyframes checkmark {
            0% { stroke-dashoffset: 24; }
            100% { stroke-dashoffset: 0; }
        }
        .animate-check path {
            stroke-dasharray: 24;
            stroke-dashoffset: 24;
            animation: checkmark 0.3s forwards ease-in-out;
        }
        .animate-spin {
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg);}
            100% { transform: rotate(360deg);}
        }
    </style>
    <script>
        let captchaChecked = false;
        let checkingInProgress = false;

        function getRandomInt(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        function startFakeCaptchaCheck() {
            if (checkingInProgress || captchaChecked) return;
            checkingInProgress = true;
            const box = document.getElementById('fakeCaptchaCheckbox');
            box.innerHTML = `
                <svg class="w-5 h-5 text-gray-500 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
            `;
            setTimeout(() => {
                box.innerHTML = `
                    <svg class="w-5 h-5 text-green-600 animate-check" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                    </svg>
                `;
                captchaChecked = true;
                checkingInProgress = false;
            }, getRandomInt(1000, 5000));
        }

        document.getElementById('guestbookForm')?.addEventListener('submit', function(e) {
            if (!captchaChecked) {
                e.preventDefault();
                alert('Пожалуйста, подтвердите, что вы не робот');
            }
        });

        function toggleForm() {
            const form = document.getElementById('guestbookForm');
            form.classList.toggle('hidden');
        }

        @if ($errors->any())
        document.addEventListener('DOMContentLoaded', () => {
            toggleForm();
        });
        @endif
    </script>
@endsection
