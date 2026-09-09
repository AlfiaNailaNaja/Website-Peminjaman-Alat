@props(['name', 'label', 'type' => 'text', 'value' => ''])

<div class="mb-3">
    @if($label)
        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    @endif
    
    <input type="{{ $type }}" 
           class="form-control @error($name) is-invalid @enderror" 
           id="{{ $name }}"
           name="{{ $name }}" 
           value="{{ $attributes->has('readonly') ? $value : old($name, $value) }}" 
           {{ $attributes }}>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>