@props([
    'value' => '', 'name', 'placeholder' => '', 'label' => '', 
])

<div class="form-group">
    <label for="{{ $name }}" >{{ $label }}</label>
    <input name="{{ $name }}"
           id="{{ $name }}"
           value="{{ old($name, $value) }}"
           placeholder="{{ $placeholder }}"
           {{ $attributes->merge([
            'type' => 'text'
           ])->class(['form-control', 'is-invalid' => $errors->has($name)]) }} />
    <x-error name="{{ $name }}"/>
</div>
