@extends('layouts.app')


@section('title')Главная страница@endsection

@section('content')
    <div class="space-y-6">
        <h2 class="text-3xl font-bold text-gray-100">Borodin Mikhail Alekseevich aka REST</h2>
        <img src="{{ asset('images/myPhoto.jpg') }}" alt="My Photo" class="w-64 h-auto rounded-xl shadow-lg border border-gray-700">
        <h3 class="text-xl font-semibold text-gray-300">Group: IS-b/22-1-o</h3>
        <h3 class="text-xl font-semibold text-gray-300">Information about LR:</h3>
        <table class="w-full max-w-md text-left border-collapse border border-gray-700 text-gray-200">
            <tbody>
            <tr class="border-b border-gray-700">
                <th class="px-4 py-2 font-medium bg-gray-800">Number LR</th>
                <td class="px-4 py-2">1</td>
            </tr>
            <tr>
                <th class="px-4 py-2 font-medium bg-gray-800">Name LR</th>
                <td class="px-4 py-2">Creating multi-page website</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
