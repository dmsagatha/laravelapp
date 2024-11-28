@props(['options'])

@if($label ?? null)
  <label for="{{ $key }}" class="select--label required {{ $class ?? '' }}">
    {{ $label }}
  </label>
@endif

<div class="mt-2">
    <select
        {{ $attributes->merge([
            'class' =>
                'select--control',
        ]) }}>
        @foreach ($options as $key => $value)
            <option value="{{ $key }}" @selected(old('class_id') == $key)>{{ $value }}</option>
        @endforeach
    </select>
</div>

{{-- @if($label ?? null)
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
  <p {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-rose-400']) }}>
    {{ $message }}
  </p>
@enderror --}}