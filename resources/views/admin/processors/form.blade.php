<div class="grid grid-cols-6 gap-x-10 gap-y-8">
  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative z-0 group mt-3">
      <x-input name="mac" id="inputMac" value="{{ old('mac', $processor->mac) }}" autocomplete="mac" autofocus
        maxlength='17' />
      <x-label for="mac" class="required" value="Mac" />
    </div>
  </div>

  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative z-0 group mt-3">
      <x-input name="servicetag" id="inputServicetag" value="{{ old('servicetag', $processor->servicetag) }}"
        autocomplete="servicetag" autofocus />
      <x-label for="servicetag" class="required" value="Servicetag" />
    </div>
  </div>

  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative form-group">
      <x-input-select name="user_id" id="user_id" :options="$users"
        :selected="old('user_id', $processor->user->id ?? '')" label="Usuario" />
    </div>
  </div>

  <div class="col-span-6 sm:col-span-3">
    <div class="relative form-group">
      <x-select-label name="model_type" id="model_type" label="Tipo de Modelo">
        @foreach ($model_types as $value => $label)
        <option value="{{ $value }}" {{ old('model_type')==$label ? 'selected' : ($processor->prototype->model_type ==
          $label ? 'selected' : '') }}>
          {{ $label }}
        </option>
        @endforeach
      </x-select-label>
    </div>
  </div>

  <div class="col-span-6 sm:col-span-3">
    <div class="relative form-group">
      <x-select-label name="prototype_id" id="reference" label="Referencia de Modelo" disabled
        data-selected="{{ old('prototype_id', $processor->prototype_id ?? '') }}">
        <option value="">Seleccionar Referencia</option>
      </x-select-label>
    </div>
  </div>
</div>

{{-- Memorias adicionales --}}
<div class="mb-4">
  <button type="button" id="add-memory" class="mt-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Agregar Memoria</button>
  @error('memories')
    <div class="text-red-500 text-sm">{{ $message }}</div>
  @enderror
</div>
<div id="selected-memories" class="mb-4" @if(empty($processor->memories)) style="display: none;" @endif>
  <table class="table-auto w-full">
    <thead>
      <tr>
        <th class="px-4 py-2">Memoria</th>
        <th class="px-4 py-2">Cantidad</th>
        <th class="px-4 py-2">Acciones</th>
      </tr>
    </thead>
    <tbody>
      @if(isset($processor))
        @foreach ($processor->memories as $memory)
          <tr>
            <td class="px-4 py-2">
                <select name="memories[]" class="select--control sm:w-80 md:w-60 p-2">
                  <option value="">Seleccionar</option>
                  @foreach ($memories as $mem)
                    <option value="{{ $mem->id }}" {{ $mem->id == $memory->id ? 'selected' : '' }}>
                      {{ $mem->serial }} - {{ $mem->technology }} - {{ $mem->capacity }}
                    </option>
                  @endforeach
                </select>
            </td>
            <td class="px-4 py-2">
              <input type="number" name="quantity_mem[{{ $memory->id }}]" class="block py-2 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer text-center" value="{{ old('quantity_mem.' . $memory->id, $memory->pivot->quantity_mem) }}" placeholder="Quantity for {{ $memory->type }}">
            </td>
            <td class="px-4 py-2">
              <button type="button" class="remove-memory bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                Eliminar
              </button>
            </td>
          </tr>
        @endforeach
      @endif
    </tbody>
  </table>
</div>