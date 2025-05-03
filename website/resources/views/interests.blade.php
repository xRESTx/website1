@extends('layouts.app')

@section('title', 'My Interests')

@section('content')
    <div class="flex flex-col md:flex-row gap-6">
        <!-- Sidebar for navigation -->
        <aside class="w-64 h-full bg-gray-800 rounded-xl p-4 shadow-lg">
            <h2 class="text-xl font-semibold text-white mb-4">Navigation of Interests</h2>
            <ul class="space-y-2" id="interestLinks">
                @foreach ($interests as $key => $interest)
                    <li>
                        <a href="#" onclick="showSection('{{ $key }}', this); return false;"
                           class="flex justify-between items-center text-gray-300 hover:text-white transition">
                            <i data-lucide="arrow-right-from-line" class="icon hidden"></i>
                            {{ $interest['title'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </aside>

        <!-- Content sections -->
        <div class="w-full md:w-3/4 space-y-6">
            @foreach ($interests as $key => $interest)
                <div id="{{ $key }}" class="content-section hidden">
                    <h3 class="text-2xl font-bold text-white mb-2">{{ $interest['title'] }}</h3>

                    @if (!empty($interest['image']))
                        <img src="{{ asset('images/' . $interest['image']) }}" alt="{{ $interest['title'] }}"
                             class="rounded-xl w-full max-w-md mb-4 shadow-md">
                    @endif

                    @if (isset($interest['content']))
                        <div class="text-gray-300 space-y-2">
                            @foreach ((array) $interest['content'] as $contentItem)
                                <p>{{ $contentItem }}</p>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function showSection(sectionId, link) {
            const sections = document.querySelectorAll('.content-section');
            sections.forEach(section => section.classList.add('hidden'));

            const selectedSection = document.getElementById(sectionId);
            if (selectedSection) {
                selectedSection.classList.remove('hidden');
            }

            const links = document.querySelectorAll('#interestLinks a');
            links.forEach(a => {
                a.classList.remove('text-white');
                a.classList.add('text-gray-300');
                a.querySelector('.icon').classList.add('hidden');
            });

            link.classList.remove('text-gray-300');
            link.classList.add('text-white');
            link.querySelector('.icon').classList.remove('hidden');
        }

        window.onload = function () {
            const firstLink = document.querySelector('#interestLinks a');
            if (firstLink) {
                showSection(Object.keys(@json($interests))[0], firstLink);
            }
        };
    </script>
@endsection
