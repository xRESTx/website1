@extends('layouts.app')

@section('title', 'Log')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Логи посещений сайта</h1>

    <table class="border-b border-gray-700">
        <thead>
        <tr class="px-4 py-2 font-medium bg-gray-800">
            <th class="py-2 px-4 border">Дата и время</th>
            <th class="py-2 px-4 border">Страница</th>
            <th class="py-2 px-4 border">IP-адрес</th>
            <th class="py-2 px-4 border">Имя хоста</th>
            <th class="py-2 px-4 border">Браузер</th>
        </tr>
        </thead>
        <tbody>
        @foreach($visits as $visit)
            <tr>
                <td class="py-2 px-4 border">{{ $visit->visited_at }}</td>
                <td class="py-2 px-4 border break-all">{{ $visit->url }}</td>
                <td class="py-2 px-4 border">{{ $visit->ip_address }}</td>
                <td class="py-2 px-4 border">{{ $visit->host ?? '-' }}</td>
                <td class="py-2 px-4 border">{{ $visit->user_agent }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $visits->links() }}
    </div>
@endsection
