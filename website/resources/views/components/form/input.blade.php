@props([
    'type' => 'text',
    'name',
    'fieldLabel' => '',
    'required' => false,
])

<div class="form-group">
    @if ($fieldLabel)
        <label for="{{ $name }}" class="form-label">{{ $fieldLabel }}</label>
    @endif

    <input type="{{ $type }}"
           name="{{ $name }}"
           id="{{ $name }}"
           value="{{ $type === 'checkbox' ? $attributes->get('value') : old($name) }}"
           @if ($required) required @endif

        {{-- Для чекбоксов устанавливаем checked, если old содержит это значение --}}
    @if ($type === 'checkbox')
        @php
            $oldValues = old(\Str::before($name, '[]'), []);
            $isChecked = in_array($attributes->get('value'), (array)$oldValues);
        @endphp
            {{ $isChecked ? 'checked' : '' }}
        @endif

        {{ $attributes->merge(['class' => 'form-input']) }}>
</div>
