@props(['name', 'id', 'options', 'selected', 'label'])

@if (!empty($label))
  <label for="{{ $id ?? $name }}" class="select--label required {{ $class ?? '' }}">
    {{ $label }}
  </label>
@endif

<select name="{{ $name }}" id="{{ $id ?? $name }}" {{ $attributes->merge(['class' => 'select--control' . ($errors->has($name) ? ' border-red-500' : '')]) }}>
  <option selected value="">Seleccionar</option>
  @foreach ($options as $value => $label)
    <option value="{{ $value }}" {{ old($name, $selected) == $value ? 'selected' : '' }}>
      {{ $label }}
    </option>
  @endforeach
</select>

<!-- Spinner -->
<div x-data="{ loading: false }" x-show="loading" class="absolute inset-y-0 right-0 flex items-center pr-3">
    <svg class="animate-spin h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 100 8v4a8 8 0 01-8-8z"></path>
    </svg>
</div>

@error($name)
  <p {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-rose-400']) }}>
    {{ $message }}
  </p>
@enderror