<div class="grid grid-cols-6 gap-x-10 gap-y-8">
  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative z-0 group mt-3">
      <x-input name="serial" id="inputSerial" value="{{ old('serial', $memory->serial) }}" autocomplete="serial" autofocus />
      <x-label for="serial" class="required" value="Serial" />
    </div>
  </div>

  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative z-0 group">
      <x-input-select name="capacity" :options="$capacities" :selected="old('capacity', $memory->capacity ?? '')" label="Capacidad" />
    </div>
  </div>

  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative form-group">
      <x-input-select name="technology" id="selectTechnology" :options="$technologies" :selected="old('technology', $memory->technology ?? '')" label="Tecnología" />
        <div x-show="loading" class="absolute inset-y-0 right-0 flex items-center pr-3">
          <svg class="animate-spin h-5 w-5 text-gray-500 dark:text-gray-300" 
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
        >
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 100 8v4a8 8 0 01-8-8z"></path>
          </svg>
        </div>
    </div>
  </div>

  {{-- Todas las opciones funcionan --}}
  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative form-group">
      {{-- <x-select-label name="velocity" id="selectVelocity" label="Velocidades">
        @if ($memory->technology != null)
          @foreach ($velocities as $value => $label)
            <option value="{{ $value }}" {{ old('velocity') == $label ? 'selected' : ($memory->velocity == $label ? 'selected' : '') }}>
              {{ $label }}
            </option>
          @endforeach
        @endif
      </x-select-label> --}}

      {{-- <x-select-label name="velocity" id="selectVelocity" label="Velocidades">
        @if (!empty($velocities))
          @foreach ($velocities as $value)
            <option value="{{ $value }}" @selected(old('velocity', $memory->velocity) == $value)>
              {{ $value }}
            </option>
          @endforeach
        @endif
      </x-select-label> --}}

      <x-select-label name="velocity" id="selectVelocity" label="Velocidades">
        @if (!empty($velocities) && is_array($velocities))
          {{-- @foreach ($velocities as $value)
            <option value="{{ $value }}" @selected(old('velocity', $memory->velocity ?? '') == $value)>
              {{ $value }}
            </option>
          @endforeach --}}
          @foreach ($velocities as $key => $label)
            <option value="{{ $key }}" {{ old('velocity') == $label ? 'selected' : ($memory->velocity == $label ? 'selected' : '') }}>
              {{ $label }}
            </option>
          @endforeach
        @endif
      </x-select-label>
    </div>
  </div>

  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative z-0 group mt-3">
      <x-input type="text" name="initial_warranty" id="initial_warranty" class="warranties" value="{{ old('initial_warranty', $memory->initial_warranty) }}" />
      <x-label for="initial_warranty" class="required" value="Fecha de compra" />
    </div>
  </div>
  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative z-0 group mt-3">
      <x-input type="text" name="final_warranty" id="final_warranty" class="warranties" value="{{ old('final_warranty', $memory->final_warranty) }}" />
      <x-label for="final_warranty" class="required" value="Fecha de venta" />
    </div>
  </div>

  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative z-0 group mt-3">
      <x-input type="text" id="birthdate" name="birthdate" value="{{ old('birthdate', $memory->birthdate) }}" />
      <x-label for="birthdate" value="Fecha de nacimiento" />
      <p id="ageError" class="text-red-500 text-sm mt-2 hidden">Debes tener al menos 18 años.</p>
    </div>
  </div>
</div>