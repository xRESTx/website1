@extends('layouts.app')

@section('title', 'Guestbook')

@section('content')
    <h2 class="text-2xl font-bold text-white mb-4">Гостевая книга</h2>

    @if(session('success'))
        <x-alert type="success" :messages="session('success')" />
    @endif

    {{-- Кнопка раскрытия --}}
    <div id="toggleSection" onclick="toggleForm()"
         class="mb-4 bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded flex items-center justify-between cursor-pointer select-none"
         style="width: 180px;">
        <span>Написать отзыв</span>
        <svg id="arrowIcon" class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
        </svg>
    </div>


    {{-- Форма: скрыта по умолчанию --}}
    <form id="guestbookForm" action="{{ route('guestbook.submit') }}" method="POST"
          class="hidden mb-8 space-y-4 bg-gray-800 p-6 rounded max-w-2xl mx-auto mt-16">
        @csrf

        {{-- Другие поля --}}
        <x-form.input name="lastname" fieldLabel="Фамилия" required />
        <x-form.input name="firstname" fieldLabel="Имя" required />
        <x-form.input name="middlename" fieldLabel="Отчество" />
        <x-form.input name="email" fieldLabel="E-mail" type="email" required />
        <x-form.textarea name="message" fieldLabel="Текст отзыва" required />

        {{-- Фейковая капча с анимацией --}}
        <div class="flex items-center space-x-2 cursor-pointer select-none" onclick="startFakeCaptchaCheck()" style="user-select:none;">
            <div id="fakeCaptchaCheckbox" class="w-6 h-6 border-2 border-gray-300 rounded flex items-center justify-center bg-white relative overflow-hidden">
                <!-- Сюда будут добавляться спиннер или галочка -->
            </div>
            <label class="text-white select-none">Я не робот</label>
        </div>

        <x-form.button type="submit" fieldLabel="Отправить отзыв"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded" />
    </form>

    {{-- Таблица сообщений --}}
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

    <style>
        /* Анимация галочки */
        @keyframes checkmark {
            0% {
                stroke-dashoffset: 24;
            }
            100% {
                stroke-dashoffset: 0;
            }
        }
        .animate-check path {
            stroke-dasharray: 24;
            stroke-dashoffset: 24;
            animation: checkmark 0.3s forwards ease-in-out;
        }

        /* Вращающийся спиннер */
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
            if (checkingInProgress || captchaChecked) return; // блокируем повторные клики

            checkingInProgress = true;
            const box = document.getElementById('fakeCaptchaCheckbox');

            // Показываем спиннер
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

        // Чтобы форму нельзя было отправить без подтверждения
        document.getElementById('guestbookForm').addEventListener('submit', function(e) {
            if (!captchaChecked) {
                e.preventDefault();
                alert('Пожалуйста, подтвердите, что вы не робот');
            }
        });

        function toggleForm() {
            const form = document.getElementById('guestbookForm');
            form.classList.toggle('hidden');
        }

        // если была валидация и данные вернулись — открыть форму
        @if ($errors->any())
        document.addEventListener('DOMContentLoaded', () => {
            toggleForm();
        });
        @endif
    </script>
@endsection
