@extends('layouts.app')

@section('title', 'Photo')

@section('content')
    <div class="container mx-auto px-4 py-10">
        <h2 class="text-2xl font-semibold text-gray-300 mb-5">My Photos</h2>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($photos as $photo)
                <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <img src="{{ asset('images/' . $photo['file']) }}" alt="{{ $photo['caption'] }}"
                         class="w-full h-auto object-cover rounded-lg mb-3 transition-transform duration-300 hover:scale-105"
                    >
                    <p class="text-center text-gray-400 text-sm">{{ $photo['caption'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
