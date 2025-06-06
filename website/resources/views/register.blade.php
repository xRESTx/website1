@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
    <form method="POST" action="{{ route('register-form') }}" class="max-w-md mx-auto bg-gray-800 p-6 rounded-lg mt-8">
        @csrf
        <h2 class="text-white text-xl font-bold mb-4">Регистрация</h2>

        {{-- Показываем ошибки --}}
        @if($errors->any())
            <div class="mb-4 text-red-500">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <x-form.input name="username" fieldLabel="Логин" required onblur="checkUsernameAvailability()" />
        <span id="username-status" class="text-sm mt-1"></span>
        <x-form.input name="email" fieldLabel="Email" type="email" required />
        <x-form.input name="password1" fieldLabel="Пароль" type="password" required />
        <x-form.input name="password2" fieldLabel="Повторите пароль" type="password" required />

        <x-form.button type="submit" fieldLabel="Зарегистрироваться" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded" />
    </form>
@endsection

<script>
    function togglePassword(inputId, btn) {
        const input = document.getElementById(inputId);
        if (input.type === "password") {
            input.type = "text";
            btn.textContent = "👁";
        } else {
            input.type = "password";
            btn.textContent = "👁";
        }
    }
</script>
<script>
    function checkUsernameAvailability() {
        const usernameInput = document.querySelector('input[name="username"]');
        const statusSpan = document.getElementById('username-status');
        const username = usernameInput.value.trim();

        if (username === '') {
            statusSpan.textContent = '';
            return;
        }

        fetch('{{ route('check.username') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ username: username })
        })
            .then(response => response.json())
            .then(data => {
                if (data.available) {
                    statusSpan.textContent = 'Логин доступен';
                    statusSpan.classList.remove('text-red-500');
                    statusSpan.classList.add('text-green-500');
                } else {
                    statusSpan.textContent = 'Логин уже занят';
                    statusSpan.classList.remove('text-green-500');
                    statusSpan.classList.add('text-red-500');
                }
            })
            .catch(error => {
                console.error('Ошибка при проверке логина:', error);
                statusSpan.textContent = 'Ошибка при проверке логина';
                statusSpan.classList.remove('text-green-500');
                statusSpan.classList.add('text-red-500');
            });
    }
</script>

