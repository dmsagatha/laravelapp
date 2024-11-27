@if($label ?? null)
  <label for="{{ $key }}" class="block text-xs font-medium text-slate-700 dark:text-slate-300 required {{ $class ?? '' }}">
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