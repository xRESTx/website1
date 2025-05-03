<div x-data="{ open: true }"
     x-init="setTimeout(() => open = false, {{ $timeout ?? 4000 }})"
     x-show="open"
     class="relative overflow-hidden p-4 rounded-lg mb-4"
     :class="{
        'bg-red-500': '{{ $type }}' === 'error',
        'bg-green-500': '{{ $type }}' === 'success',
     }"
     x-transition>

    <button @click="open = false"
            class="absolute top-2 right-2 text-2xl font-bold leading-none text-white hover:text-gray-300">
        &times;
    </button>

    @if($type === 'error')
        <ul class="list-disc list-inside text-white">
            @foreach ($messages as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    @else
        <p class="text-white">{{ $messages }}</p>
    @endif
</div>
