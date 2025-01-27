@props(['disabled' => false, 'options' => [], 'selected' => null, 'default' => null])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'select--control']) !!}>
  <option value="">Seleccionar</option>
  @foreach($options as $key => $value)
    <option value="{{ $key }}" @selected($selected === $key || $default === $value)>
      {{ $value }}
    </option>
  @endforeach
</select>