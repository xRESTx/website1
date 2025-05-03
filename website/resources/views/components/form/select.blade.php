@props([
    'name',
    'fieldLabel' => '',
    'options' => [],
    'required' => false,
])

<div class="form-group">
    <label for="{{ $name }}" class="form-label">{{ $fieldLabel }}</label>
    <select name="{{ $name }}" id="{{ $name }}" {{ $required ? 'required' : '' }} class="form-select">
        @foreach($options as $key => $option)
            @if(is_array($option))
                <optgroup label="{{ $key }}">
                    @foreach($option as $optValue => $optLabel)
                        <option value="{{ $optValue }}">{{ $optLabel }}</option>
                    @endforeach
                </optgroup>
            @else
                <option value="{{ $key }}">{{ $option }}</option>
            @endif
        @endforeach
    </select>
</div>
