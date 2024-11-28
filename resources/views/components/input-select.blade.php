@props(['name', 'options', 'selected'])

<select name="{{ $name }}" id="{{ $name }}" 
        {{ $attributes->merge(['class' => 'form-select border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 w-full' . ($errors->has($name) ? ' border-red-500' : '')]) }}>
    @foreach ($options as $value => $label)
        <option value="{{ $value }}" {{ old($name, $selected) == $value ? 'selected' : '' }}>
            {{ $label }}
        </option>
    @endforeach
</select>

@error($name)
    <span class="text-red-500 text-xs">{{ $message }}</span>
@enderror
