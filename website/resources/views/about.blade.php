@extends('layouts.app')

@section('title', 'About me')

@section('content')
    <section class="space-y-6">
        <h2 class="text-3xl font-bold text-gray-100">Autobiography</h2>

        <p class="text-gray-300 flex items-center gap-2">
            <svg data-lucide="compass" class="w-5 h-5 text-gray-400"></svg>
            I like tourism
        </p>

        <img src="{{ asset('images/travel.jpg') }}" alt="photo in travel"
             class="w-64 h-auto rounded-xl shadow-lg border border-gray-700 ">

        <p class="text-gray-300 flex items-center gap-2">
            <svg data-lucide="music" class="w-5 h-5 text-gray-400"></svg>
            I like music
        </p>

        <p class="text-gray-300 flex items-center gap-2">
            <svg data-lucide="code" class="w-5 h-5 text-gray-400"></svg>
            I’m developing in information technologies
        </p>
    </section>
@endsection
