@extends('layouts.app')

@section('title', 'Мой Блог')

@section('content')
    <h2 class="text-3xl font-semibold mb-6">Мой Блог</h2>

{{--    @forelse ($posts as $post)--}}
{{--        <div class="bg-gray-800 rounded-lg p-5 mb-6 shadow-md">--}}
{{--            <h3 class="text-2xl font-bold text-white mb-1">{{ $post->title }}</h3>--}}
{{--            <p class="text-sm text-gray-400 mb-2">{{ $post->created_at->format('d.m.Y H:i') }}</p>--}}

{{--            @if ($post->image_path)--}}
{{--                <img src="{{ asset('storage/' . $post->image_path) }}" alt="Image" class="w-full max-w-lg rounded mb-4">--}}
{{--            @endif--}}

{{--            <p class="text-gray-300 whitespace-pre-line">{{ $post->body }}</p>--}}
{{--        </div>--}}
{{--        @if($user)--}}
{{--            <div class="container">--}}
{{--                <button onclick="openModal({{$el->id}})">Добавить комментарий</button>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    @empty--}}
{{--        <p class="text-gray-400">Нет записей в блоге.</p>--}}
{{--    @endforelse--}}

    @foreach ($posts as $post)
        <div id="post-{{ $post->id }}" class="bg-gray-800 p-4 rounded mb-6">
            <h3 class="text-xl font-bold text-white">{{ $post->title }}</h3>
            @if ($post->image_path)
                <img src="{{ asset('storage/' . $post->image_path) }}" alt="Image" class="w-full max-w-lg rounded mb-4">
            @endif
            <p class="text-white">{{ $post->body }}</p>

            <!-- Комментарии -->
            <div id="comments-{{ $post->id }}" class="mt-4 space-y-2">
                @foreach ($post->comments as $comment)
                    <div class="bg-gray-700 p-3 rounded text-white">
                        <strong>{{ $comment->author }}</strong>
                        <span class="text-sm text-gray-400">{{ $comment->created_at->format('d.m.Y H:i') }}</span>
                        <p>{{ $comment->body }}</p>
                    </div>
                @endforeach
            </div>

            @if(session('username'))
                <div class="mt-2">
                    <button onclick="openCommentModal({{ $post->id }})" class="text-blue-400 hover:underline">Добавить комментарий</button>
                </div>
            @endif
        </div>
    @endforeach


    <div class="mt-6">
        {{ $posts->links('components.pagination') }}
    </div>

    <div id="commentModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-gray-800  p-6 rounded w-96">
            <h4 class="text-lg font-semibold mb-2">Ваш комментарий</h4>
            <input type="hidden" id="commentPostId" value="">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <textarea id="commentBody" rows="4" class="bg-gray-600 w-full  rounded p-2 mb-4"></textarea>
{{--            <input type="hidden" id="commentPostId">--}}
            <div class="text-right">
                <button onclick="closeCommentModal()" class="mr-2 text-gray-300 hover:underline">Отмена</button>
                <button onclick="sendComment()" class="bg-blue-600 text-white px-4 py-2 rounded">Отправить</button>
            </div>
        </div>
    </div>

@endsection
<script>
    function openCommentModal(postId) {
        document.getElementById('commentPostId').value = postId;
        document.getElementById('commentModal').classList.remove('hidden');
    }

    function closeCommentModal() {
        document.getElementById('commentModal').classList.add('hidden');
        document.getElementById('commentBody').value = '';
    }
    function sendComment() {
        const postId = document.getElementById('commentPostId').value;
        const comment = document.getElementById('commentBody').value;
        const token = document.querySelector('input[name="_token"]').value;

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "/blog/comment", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.setRequestHeader("X-CSRF-TOKEN", token);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);

                    const commentsSection = document.getElementById('comments-' + postId);
                    const newCommentDiv = document.createElement('div');
                    newCommentDiv.classList.add('bg-gray-700', 'p-3', 'rounded', 'text-white');
                    newCommentDiv.innerHTML = `
                    <strong>${response.author}</strong>
                    <span class="text-sm text-gray-400">${response.created_at}</span>
                    <p>${response.comment}</p>
                `;
                    commentsSection.appendChild(newCommentDiv);

                    alert("Комментарий отправлен!");
                    closeCommentModal();
                    document.getElementById('commentBody').value = '';
                } else {
                    console.error("Ошибка:", xhr.status, xhr.responseText);
                    alert("Ошибка при отправке комментария");
                }
            }
        };

        const data = `post_id=${encodeURIComponent(postId)}&comment=${encodeURIComponent(comment)}`;
        xhr.send(data);
    }

</script>

