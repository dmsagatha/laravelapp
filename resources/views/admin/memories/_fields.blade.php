<div class="grid grid-cols-6 gap-x-10 gap-y-8">
  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative z-0 group mt-4">
      <x-input name="serial" id="inputSerial" value="{{ old('serial', $memory->serial) }}" autocomplete="serial" autofocus />
      <x-label for="serial" class="required" value="Serial" />
    </div>
  </div>

  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative z-0 group mt-2">
      <x-input-select name="capacity" :options="$capacities" :selected="old('capacity', $memory->capacity ?? '')" label="Capacidades" placeholder=" " />
    </div>
  </div>

  {{-- <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative z-0 group mt-2">
      <x-input-label for="capacity" :value="__('Capacidades')" />
      <x-select-label name="capacity" id="selectCapacity" :options="$capacities" label="Capacidad" />
      <x-input-error :messages="$errors->get('capacity')" />
    </div>
  </div> --}}
</div>