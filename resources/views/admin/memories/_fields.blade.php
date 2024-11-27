<div class="grid grid-cols-6 gap-x-10 gap-y-8">
  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative z-0 group mt-4">
      <x-input name="serial" id="inputSerial" value="{{ old('serial', $memory->serial) }}" autocomplete="serial" autofocus />
      <x-label for="serial" class="required" value="Serial" />
    </div>
  </div>

  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative z-0 group">
      <label for="capacity" class="select--label">Capacidad</label>
      <select class="select--control" name="capacity" id="selectCapacity">
        <option value="">Seleccionar</option>
        @foreach($capacities as $key => $label)
          <option value="{{ $label }}" {{ old('capacity') == $label ? 'selected' : ($memory->capacity == $label ? 'selected' : '') }}>
            {{ $label }}
          </option>
        @endforeach
      </select>
      @error('capacity')
        <div class="text-sm text-red-600 dark:text-rose-400">{{ $message }}</div>
      @enderror
    </div>
  </div>

  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative z-0 group">
      <label for="technology" class="select--label">Tecnología</label>
      <select class="select--control" name="technology" id="selectTechnology">
        <option value="">Seleccionar</option>
        @foreach($technologies as $key => $label)
          <option value="{{ $label }}" {{ old('technology') == $label ? 'selected' : ($memory->technology == $label ? 'selected' : '') }}>
            {{ $label }}
          </option>
        @endforeach
      </select>
      @error('technology')
        <div class="text-sm text-red-600 dark:text-rose-400">{{ $message }}</div>
      @enderror
    </div>
    </div>
  </div>

  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative z-0 group mt-5">
      <label for="velocity" class="select--label">Velocidad</label>
      <select class="select--control" name="velocity" id="selectVelocity">
        <option value="">Seleccionar</option>
        @if ($memory->technology != null)
          @foreach ($velocities as $key => $label)
          <option value="{{ $label }}" {{ old('velocity') == $label ? 'selected' : ($memory->velocity == $label ? 'selected' : '') }}>
            {{ $label }}
          </option>
          @endforeach
        @endif
      </select>
      @error('velocity')
        <div class="text-sm text-red-600 dark:text-rose-400">{{ $message }}</div>
      @enderror
    </div>
  </div>
</div>