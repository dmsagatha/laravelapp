@props(['options' => []])

<select {{ $attributes->merge(['class' => 'select--control']) }}>
  <option>Seleccionar</option>
  @foreach ($options as $key => $value)
    <option value="{{ $key }}">{{ $value }}</option>
    {{-- <option value="India" @selected(old('country') ?? $country == 'India')>India</option>
    <option value="Pakistan" @selected(old('country') ?? $country == 'Pakistan')>Pakistan</option> --}}
  @endforeach
</select>