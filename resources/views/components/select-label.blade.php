@props(['options'])

@if($label ?? null)
  <label for="{{ $key }}" class="select--label required {{ $class ?? '' }}">
    {{ $label }}
  </label>
@endif
<select {{ $attributes->merge(['class' => 'select--control']) }}>
  <option selected value="">Seleccionar</option>
  @foreach ($options as $key => $value)
    <option value="{{ $key }}" @selected(old('class_id')==$key)>{{ $value }}</option>
  @endforeach
</select>
@error($key)
  <p {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-rose-400']) }}>
    {{ $message }}
  </p>
@enderror
