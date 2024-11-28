<div class="grid grid-cols-6 gap-x-10 gap-y-8">
  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative z-0 group mt-4">
      <x-input name="serial" id="inputSerial" value="{{ old('serial', $memory->serial) }}" autocomplete="serial" autofocus />
      <x-label for="serial" class="required" value="Serial" />
    </div>
  </div>

  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative z-0 group mt-2">
      <x-input-select name="capacity" :options="$capacities" :selected="old('capacity', $memory->capacity ?? '')" label="Capacidades" />
    </div>
  </div>

  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative form-group mt-1">
      <x-input-select name="technology" id="selectTechnology" :options="$technologies" :selected="old('technology', $memory->technology ?? '')" label="Tecnología" />
        <div x-show="loading" class="absolute inset-y-0 right-0 flex items-center pr-3">
            <svg 
                class="animate-spin h-5 w-5 text-gray-500 dark:text-gray-300" 
                xmlns="http://www.w3.org/2000/svg" 
                fill="none" 
                viewBox="0 0 24 24"
            >
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 100 8v4a8 8 0 01-8-8z"></path>
            </svg>
        </div>
    </div>
  </div>

  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative form-group mt-1">
      <x-select-label name="velocity" id="selectVelocity" label="Velocidades">
        @if ($memory->technology != null)
          @foreach ($velocities as $value => $label)
            <option value="{{ $value }}" {{ old('velocity') == $label ? 'selected' : ($memory->velocity == $label ? 'selected' : '') }}>
              {{ $label }}
            </option>
          @endforeach
        @endif
      </x-select-label>
    </div>
  </div>

  {{-- <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative form-group mt-1">
      <label for="velocity" class="select--label">Velocidad</label>
      <select class="select--control" name="velocity" id="selectVelocity">
        <option value="">Seleccionar</option>
        @if ($memory->technology != null)
          @foreach ($velocities as $key => $label)
            <option value="{{ $key }}" {{ old('velocity') == $label ? 'selected' : ($memory->velocity == $label ? 'selected' : '') }}>
              {{ $label }}
            </option>
          @endforeach
        @endif
      </select>
      @error('velocity')
        <div class="text-sm text-red-600 dark:text-rose-400">{{ $message }}</div>
      @enderror
    </div>
  </div> --}}
</div>