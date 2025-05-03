@props([
    'type' => 'text',
    'name',
    'fieldLabel' => '',
    'required' => false,
])

<div class="form-group">
    <label for="{{ $name }}" class="form-label">{{ $fieldLabel }}</label>
    <input type="{{ $type }}"
           name="{{ $name }}"
           id="{{ $name }}"
           value="{{ old($name) }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'form-input']) }}>
</div>
