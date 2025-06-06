@extends('layouts.app')

@section('title', 'Редактор Блога')

@section('content')
    <h2 class="text-2xl font-semibold mb-4">Добавить запись</h2>

    @if ($errors->any())
        <x-alert type="error" :messages="$errors->all()" />
    @endif

    @if (session('success'))
        <x-alert type="success" :messages="session('success')" />
    @endif

    <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 mb-8">
        @csrf
        <x-form.input name="title" fieldLabel="Тема сообщения" required />
        <x-form.input name="image" fieldLabel="Изображение" type="file" />
        <x-form.textarea name="body" fieldLabel="Текст сообщения" rows="6" required />

        <x-form.button type="submit" fieldLabel="Publish" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-md shadow-md" />
    </form>

    <h2 class="text-xl font-semibold mt-10 mb-4">Импорт постов из CSV</h2>

    @if (session('csv_errors'))
        <div class="bg-red-800 text-white p-4 rounded mb-4">
            <h3 class="font-bold mb-2">Ошибки при валидации строк:</h3>
            <ul class="list-disc pl-5 space-y-1 text-sm">
                @foreach (session('csv_errors') as $line => $errors)
                    <li>
                        <strong>Строка {{ $line }}:</strong>
                        {{ implode('; ', array_merge(...array_values($errors))) }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('blog.csv') }}" method="POST" enctype="multipart/form-data" class="space-y-4 mb-8">
        @csrf
        <x-form.input type="file" name="csv_file" fieldLabel="CSV файл" required />
        <x-form.button type="submit" fieldLabel="Publish" text="Импортировать CSV" class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-6 rounded-md shadow-md" />
    </form>

    <h3 class="text-xl font-semibold mb-4">Список записей</h3>
    @foreach ($posts as $post)
        <div class="bg-gray-800 rounded p-4 mb-4" id="post-{{ $post->id }}">
            <h4 class="text-xl font-bold text-white" id="title-{{ $post->id }}">{{ $post->title }}</h4>
            <p class="text-gray-300 text-sm mb-2">{{ $post->created_at->format('d.m.Y H:i') }}</p>
            @if ($post->image_path)
                <img src="{{ asset('storage/' . $post->image_path) }}" alt="Image" class="w-full max-w-md mb-3 rounded" />
            @endif
            <p class="text-gray-200" id="body-{{ $post->id }}">{{ $post->body }}</p>
            <button onclick="showEditForm({{ $post->id }})" class="mt-2 text-blue-400 hover:underline">Изменить</button>

            <div id="edit-form-{{ $post->id }}" class="hidden mt-4">
                <input type="text" id="edit-title-{{ $post->id }}" value="{{ $post->title }}" class="bg-gray-600 w-full mb-2 p-2 rounded">
                <textarea id="edit-body-{{ $post->id }}" class="bg-gray-600 w-full p-2 rounded">{{ $post->body }}</textarea>
                <button onclick="submitEdit({{ $post->id }})" class="mt-2 bg-green-600 text-white py-1 px-3 rounded">Сохранить изменения</button>
            </div>
        </div>
    @endforeach
    {{ $posts->links('components.pagination') }}
@endsection
<script>
    function showEditForm(id) {
        document.getElementById('edit-form-' + id).classList.toggle('hidden');
    }

    function submitEdit(id) {
        const title = document.getElementById('edit-title-' + id).value;
        const body = document.getElementById('edit-body-' + id).value;
        const token = '{{ csrf_token() }}';

        fetch(`/blog/${id}/update`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
            },
            body: JSON.stringify({ title, body })
        })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    document.getElementById('title-' + id).innerText = data.title;
                    document.getElementById('body-' + id).innerText = data.body;
                    document.getElementById('edit-form-' + id).classList.add('hidden');
                } else if (data.errors) {
                    alert('Ошибка: ' + Object.values(data.errors).flat().join(', '));
                } else if (data.error) {
                    alert('Ошибка: ' + data.error);
                }
            })
            .catch(error => alert('Ошибка сервера: ' + error));
    }
</script>
