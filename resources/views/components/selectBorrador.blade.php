@props(['options' => []])

<select {{ $attributes->merge(['class' => 'select--control']) }}>
  <option>Seleccionar</option>
  @foreach ($options as $key => $value)
  {{-- <option value="{{ $key }}">{{ $value }}</option> --}}
  <option value="{{ $key }}" @selected(old($key) ?? $key==$value)>{{ $value }}</option>
  {{-- <option value="India" @selected(old('country') ?? $country=='India' )>India</option>
  <option value="Pakistan" @selected(old('country') ?? $country=='Pakistan' )>Pakistan</option> --}}
  @endforeach
</select>

<select {{ $attributes->merge(['class'=>'block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1
  ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6'])
  }}>
  @foreach ($options as $key => $value)
  <option value="{{ $key }}" @selected(old('class_id')==$key)>{{ $value }}</option>
  @endforeach
</select>