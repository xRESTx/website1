@props([
    'name',
    'fieldLabel' => '',
    'required' => false
])

<div class="form-group">
    <label for="{{ $name }}" class="form-label">{{ $fieldLabel }}</label>
    <textarea name="{{ $name }}" id="{{ $name }}" rows="5" {{ $required ? 'required' : '' }}
    class="form-textarea"></textarea>
</div>
