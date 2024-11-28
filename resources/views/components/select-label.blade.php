@props(['name', 'id', 'options', 'selected', 'label'])

@if (!empty($label))
  <label for="{{ $id ?? $name }}" class="select--label required {{ $class ?? '' }}">
    {{ $label }}
  </label>
@endif

<select name="{{ $name }}" id="{{ $id ?? $name }}" {{ $attributes->merge(['class' => 'select--control' .
  ($errors->has($name) ? ' border-red-500' : '')]) }}>
  <option selected value="">Seleccionar</option>
  {{ $slot }}
</select>

@error($name)
  <p {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-rose-400']) }}>
    {{ $message }}
  </p>
@enderror