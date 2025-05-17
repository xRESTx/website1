@extends('layouts.app')

@section('title', 'Мой Блог')

@section('content')
    <h2 class="text-3xl font-semibold mb-6">Мой Блог</h2>

    @forelse ($posts as $post)
        <div class="bg-gray-800 rounded-lg p-5 mb-6 shadow-md">
            <h3 class="text-2xl font-bold text-white mb-1">{{ $post->title }}</h3>
            <p class="text-sm text-gray-400 mb-2">{{ $post->created_at->format('d.m.Y H:i') }}</p>

            @if ($post->image_path)
                <img src="{{ asset('storage/' . $post->image_path) }}" alt="Image" class="w-full max-w-lg rounded mb-4">
            @endif

            <p class="text-gray-300 whitespace-pre-line">{{ $post->body }}</p>
        </div>
    @empty
        <p class="text-gray-400">Нет записей в блоге.</p>
    @endforelse

    <div class="mt-6">
        {{ $posts->links('components.pagination') }}
    </div>
@endsection
