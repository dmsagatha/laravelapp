<div class="grid grid-cols-6 gap-x-10 gap-y-8">
  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative z-0 group mt-1">
      <x-input name="serial" id="inputSerial" value="{{ old('serial', $memory->serial) }}" autocomplete="serial" autofocus />
      <x-label for="serial" class="required" value="Serial" />
    </div>
  </div>

  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative z-0 group">
      <x-select class="required" key="capacity" label="Capacidad">
        @foreach($capacities as $key => $label)
          <option value="{{ $label }}"
            {{ old('capacity') == $label ? 'selected' : ($memory->capacity == $label ? 'selected' : '') }}>
            {{ $label }}
          </option>
        @endforeach
      </x-select>
    </div>
  </div>

  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative z-0 group">
      <x-select class="required" key="technology" label="Tecnología">
        @foreach($technologies as $key => $label)
          <option value="{{ $label }}"
            {{ old('technology') == $label ? 'selected' : ($memory->technology == $label ? 'selected' : '') }}>
            {{ $label }}
          </option>
        @endforeach
      </x-select>
    </div>
  </div>

  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative z-0 group">
      <x-select class="required" key="velocity" id="velocity" label="Velocidad">
        @if ($memory->technology != null)
          @foreach ($velocities as $key => $label)
            <option value="{{ $key }}"
              {{ old('velocity') == $label ? 'selected' : ($memory->velocity == $label ? 'selected' : '') }}>
              {{ $label }}
            </option>
          @endforeach
        @endif
      </x-select>
    </div>
  </div>
</div>