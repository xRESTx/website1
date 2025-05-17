@extends('layouts.app')

@section('title', 'Результаты тестов')

@section('content')
    <h2 class="text-3xl font-semibold mb-6">Сохранённые результаты</h2>

    @if($results->isEmpty())
        <p class="text-gray-400">Пока нет данных.</p>
    @else
        <table class="w-full text-left bg-gray-800 text-white rounded-lg overflow-hidden">
            <thead class="bg-gray-700">
            <tr>
                <th class="px-4 py-2">Дата</th>
                <th class="px-4 py-2">ФИО</th>
                <th class="px-4 py-2">Группа</th>
                <th class="px-4 py-2">Ответы</th>
                <th class="px-4 py-2">Результаты</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($results as $result)
                <tr class="border-t border-gray-600">
                    <td class="px-4 py-2">{{ $result->created_at->format('d.m.Y H:i') }}</td>
                    <td class="px-4 py-2">{{ $result->fullname }}</td>
                    <td class="px-4 py-2">{{ $result->group }}</td>
                    <td class="px-4 py-2 text-sm">
                        <ul class="list-disc pl-4">
                            @foreach ($result->answers as $q => $ans)
                                <li><strong>{{ ucfirst($q) }}:</strong>
                                    @if(is_array($ans))
                                        {{ implode(', ', $ans) }}
                                    @else
                                        {{ $ans }}
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="px-4 py-2 text-sm">
                        <ul class="list-disc pl-4">
                            @foreach ($result->results as $q => $res)
                                <li><strong>{{ ucfirst($q) }}:</strong> {{ $res }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
