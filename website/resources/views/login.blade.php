@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
    <form method="POST" action="{{ route('login-form')}}" class="max-w-md mx-auto bg-gray-800 p-6 rounded-lg">
        @csrf
        <h2 class="text-white text-xl font-bold mb-4">Admin Login</h2>

        @error('password')
        <p id="error-message" class="text-red-500 mb-2">{{ $message }}</p>
        <script>
            setTimeout(() => {
                const errorMsg = document.getElementById('error-message');
                if (errorMsg) {
                    errorMsg.style.transition = 'opacity 0.5s ease-out';
                    errorMsg.style.opacity = '0';
                    setTimeout(() => errorMsg.remove(), 500);
                }
            }, 3000); // ошибка исчезнет через 3 секунды
        </script>
        @enderror

        <x-form.input name="username" fieldLabel="Login" required />
        <x-form.input name="password" fieldLabel="Password" type="password" required />
        <div class="flex justify-between">
            <x-form.button type="submit" fieldLabel="Login" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded" />
            <a href="{{ route('register') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded inline-block text-center">Sign Up</a>
        </div>
    </form>
@endsection
