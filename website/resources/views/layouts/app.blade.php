<!doctype html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'RESTs site')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-900 text-gray-200 font-sans min-h-screen flex flex-col">

<header class="bg-gray-800 shadow-md py-4">
    <div class="container mx-auto px-4 flex flex-col md:flex-row items-center justify-between">
        <h1 class="text-2xl font-semibold text-gray-400">
            <a href="{{ url('/') }}" class="hover:text-gray-300 transition">Site REST. Main page</a>
        </h1>
        <nav class="mt-3 md:mt-0">
            <ul class="flex flex-col md:flex-row gap-4 text-gray-200">
                <li><a href="{{ url('/') }}" class="hover:text-gray-300 hover:bg-gray-700 px-3 py-2 rounded transition">MainPage</a></li>
                <li><a href="{{ url('/about') }}" class="hover:text-gray-300 hover:bg-gray-700 px-3 py-2 rounded transition">About Me</a></li>
                <li><a href="{{ url('/interests') }}" class="hover:text-gray-300 hover:bg-gray-700 px-3 py-2 rounded transition">My interests</a></li>
                <li class="relative group hover:bg-gray-700">
                    <a href="{{ url('/education') }}" class="hover:text-gray-300 hover:bg-gray-700 px-3 py-2 rounded transition">Education</a>
                    <ul class="absolute left-0 mt-2 bg-gray-700 rounded-md shadow-lg opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none group-hover:pointer-events-auto z-50 min-w-[180px]">
                        <li><a href="{{ url('/education#university') }}" class="block px-4 py-2 hover:bg-gray-600">University</a></li>
                        <li><a href="{{ url('/education#notEndedTest') }}" class="block px-4 py-2 hover:bg-gray-600">Tests</a></li>
                        <li><a href="{{ url('/education#disciplines') }}" class="block px-4 py-2 hover:bg-gray-600">List of disciplines</a></li>
                    </ul>
                </li>
                <li><a href="{{ url('/photo') }}" class="hover:text-gray-300 hover:bg-gray-700 px-3 py-2 rounded transition">Photo</a></li>
                <li><a href="{{ url('/contact') }}" class="hover:text-gray-300 hover:bg-gray-700 px-3 py-2 rounded transition">Contact form</a></li>
                <li><a href="{{ url('/guestbook') }}" class="hover:text-gray-300 hover:bg-gray-700 px-3 py-2 rounded transition">Guestbook</a></li>
                <li><a href="{{ url('/blog') }}" class="hover:text-gray-300 hover:bg-gray-700 px-3 py-2 rounded transition">Blog</a></li>
                <li><a href="{{ url('/blog/editor') }}" class="hover:text-gray-300 hover:bg-gray-700 px-3 py-2 rounded transition">Blog Editor</a></li>
            </ul>
        </nav>
    </div>
</header>

<main class="flex-grow container mx-auto px-4 py-10">
    @yield('content')
</main>

<footer class="bg-gray-800 text-center py-4 text-sm text-gray-400">
    <p>&copy; REST 2024 — All rights reserved</p>
</footer>

<script>
    @yield('script')
</script>

</body>
</html>
