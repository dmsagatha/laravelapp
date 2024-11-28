@props(['name', 'options', 'selected', 'key'])
@if($label ?? null)
  <label for="{{ $key }}" class="select--label required {{ $class ?? '' }}">
    {{ $label }}
  </label>
@endif
<select
  name="{{ $key }}" 
  id="{{ $key }}" 
  {{ $attributes->merge(['class' => 'select--control']) }}
>
  <option selected value="">Seleccionar</option>
  {{ $slot }}
</select>

@error($key)
  <p {{ $attributes->merge(['class' => 'text-xs text-red-600']) }}>
    {{ $message }}
  </p>
@enderror