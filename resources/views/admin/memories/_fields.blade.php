<div class="grid grid-cols-6 gap-x-10 gap-y-8">
  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative z-0 group mt-1">
      <x-input name="serial" id="inputSerial" value="{{ (isset($memory)) ? $memory->serial : old('serial') }}" autocomplete="serial" autofocus />
      <x-label for="serial" class="required" value="Serial" />
    </div>
  </div>
</div>