@props(['name', 'options', 'selected', 'label'])

@if (!empty($label))
  <label for="{{ $id ?? $name }}" class="select--label required {{ $class ?? '' }}">
    {{ $label }}
  </label>
@endif

<select name="{{ $name }}" id="{{ $name }}" {{ $attributes->merge(['class' => 'select--control' . ($errors->has($name) ? ' border-red-500' : '')]) }}>
  <option selected value="">Seleccionar</option>
  @foreach ($options as $value => $label)
    <option value="{{ $value }}" {{ old($name, $selected)==$value ? 'selected' : '' }}>
      {{ $label }}
    </option>
  @endforeach
</select>

@error($name)
  <p {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-rose-400']) }}>
    {{ $message }}
  </p>
@enderror