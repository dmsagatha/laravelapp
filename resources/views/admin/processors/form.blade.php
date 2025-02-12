<div class="grid grid-cols-6 gap-x-10 gap-y-8">
  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative z-0 group mt-3">
      <x-input name="mac" id="inputMac" value="{{ old('mac', $processor->mac) }}" autocomplete="mac" autofocus maxlength='17' />
      <x-label for="mac" class="required" value="Mac" />
    </div>
  </div>

  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative z-0 group mt-3">
      <x-input name="servicetag" id="inputServicetag" value="{{ old('servicetag', $processor->servicetag) }}" autocomplete="servicetag" autofocus />
      <x-label for="servicetag" class="required" value="Servicetag" />
    </div>
  </div>

  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative form-group">
      <x-input-select name="user_id" id="user_id" :options="$users" :selected="old('user_id', $processor->user->id ?? '')" label="Usuario" />
    </div>
  </div>

  <div class="col-span-6 sm:col-span-3">
    <div class="relative form-group">
      <x-select-label name="model_type" id="model_type" label="Tipo de Modelo">
        @foreach ($model_types as $value => $label)
          <option value="{{ $value }}" 
            {{ old('model_type') == $label ? 'selected' : ($processor->prototype->model_type == $label ? 'selected' : '') }}>
            {{ $label }}
          </option>
        @endforeach
      </x-select-label>
    </div>
  </div>

  <div class="col-span-6 sm:col-span-3">
    <div class="relative form-group">
      <x-select-label name="prototype_id" id="reference" label="Referencia de Modelo" disabled data-selected="{{ old('prototype_id', $processor->prototype_id ?? '') }}">
      <option value="">Seleccionar Referencia</option>
      </x-select-label>
    </div>
  </div>
</div>

{{-- Memorias adicionales --}}
        <div class="mb-4">
          <label for="memory" class="block text-gray-700">Memories</label>
          <select id="memory" class="mt-1 block w-full">
              @foreach ($memories as $memory)
                  <option value="{{ $memory->id }}">{{ $memory->type }}</option>
              @endforeach
          </select>
          <button type="button" id="add-memory" class="mt-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add Memory</button>
          @error('memories')
              <div class="text-red-500 text-sm">{{ $message }}</div>
          @enderror
      </div>
      <div id="selected-memories" class="mb-4">
          <table class="table-auto w-full">
              <thead>
                  <tr>
                      <th class="px-4 py-2">Memory Type</th>
                      <th class="px-4 py-2">Quantity</th>
                      <th class="px-4 py-2">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  @if(isset($processor))
                      @foreach ($processor->memories as $memory)
                          <tr>
                              <td class="border px-4 py-2"><input type="hidden" name="memories[]" value="{{ $memory->id }}">{{ $memory->type }}</td>
                              <td class="border px-4 py-2"><input type="number" name="quantity_mem[{{ $memory->id }}]" class="mt-1 block w-full" value="{{ old('quantity_mem.' . $memory->id, $memory->pivot->quantity_mem) }}" placeholder="Quantity for {{ $memory->type }}"></td>
                              <td class="border px-4 py-2"><button type="button" class="remove-memory bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Remove</button></td>
                          </tr>
                      @endforeach
                  @endif
              </tbody>
          </table>
      </div>