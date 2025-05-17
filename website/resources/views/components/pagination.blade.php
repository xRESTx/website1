@if ($paginator->hasPages())
    <nav class="text-gray-300 mt-6">
        <span>Страницы:</span>

        @php
            $showPages = 1;
            $current = $paginator->currentPage();
            $last = $paginator->lastPage();
        @endphp

        {{-- Первая страница --}}
        @if ($current > 1 + $showPages)
            <a href="{{ $paginator->url(1) }}" class="px-2 hover:underline">1</a>
            @if ($current > 2 + $showPages)
                <span>…</span>
            @endif
        @endif

        {{-- Центр --}}
        @for ($i = max(1, $current - $showPages); $i <= min($last, $current + $showPages); $i++)
            @if ($i == $current)
                <span class="font-bold px-2">{{ $i }}</span>
            @else
                <a href="{{ $paginator->url($i) }}" class="px-2 text-blue-400 hover:underline">{{ $i }}</a>
            @endif
        @endfor

        {{-- Последняя страница --}}
        @if ($current < $last - $showPages)
            @if ($current < $last - ($showPages + 1))
                <span>…</span>
            @endif
            <a href="{{ $paginator->url($last) }}" class="px-2 text-blue-400 hover:underline">{{ $last }}</a>
        @endif
    </nav>
@endif
