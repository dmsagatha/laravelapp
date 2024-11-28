@props(['options'])

@if($label ?? null)
  <label for="{{ $key }}" class="block text-xs font-medium text-slate-700 dark:text-slate-300 required {{ $class ?? '' }}">
    {{ $label }}
  </label>
@endif
<div class="mt-2">
    <select
        {{ $attributes->merge([
            'class' =>
                'block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6',
        ]) }}>
        @foreach ($options as $key => $value)
            <option value="{{ $key }}" @selected(old('class_id') == $key)>{{ $value }}</option>
        @endforeach
    </select>
</div>

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
  <p {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-rose-400']) }}>
    {{ $message }}
  </p>
@enderror