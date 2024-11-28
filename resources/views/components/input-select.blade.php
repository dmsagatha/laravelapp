@props(['name', 'options', 'selected'])
@if (!empty($label))
    <label for="{{ $id ?? $name }}" class="block text-sm font-medium text-gray-700 mb-1">
        {{ $label }}
    </label>
@endif

<select name="{{ $name }}" id="{{ $name }}" {{ $attributes->merge(['class' => 'select--control' . ($errors->has($name) ? ' border-red-500' : '')]) }}>
  <option selected value="">Seleccionar</option>
  @foreach ($options as $value => $label)
    <option value="{{ $value }}" {{ old($name, $selected) == $value ? 'selected' : '' }}>
      {{ $label }}
    </option>
  @endforeach
</select>

@error($name)
  <p {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-rose-300']) }}>
    {{ $message }}
  </p>
@enderror