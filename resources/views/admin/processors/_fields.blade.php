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
{{-- <div id="memory-fields" class="max-w-lg mt-5 space-y-4">
  <label>Memorias RAM:</label>
  <button type="button" id="add-memory-btn" class="bg-blue-500 text-slate-50 px-4 py-2 rounded">
    Agregar
  </button>

  <table id="memory-table" class="table-auto w-full">
    <thead>
      <tr>
        <th class="text-center text-xs">Memorias</th>
        <th class="text-center text-xs">Cantidad</th>
        <th class="text-center text-sm">Acciones</th>
      </tr>
    </thead>
    <tbody id="memory-list">
      @foreach($selectedMemories as $index => $memory)
        <tr class="memory-item">
          <td>
            <select name="memories[{{ $index }}][id]" class="memory-select select--control sm:w-80 md:w-60 p-2">
              <option value="">Seleccionar</option>
              @foreach($memories as $availableMemory)
                <option value="{{ $availableMemory->id }}" {{ $memory['id'] == $availableMemory->id ? 'selected' : '' }}>
                  {{ $availableMemory->serial }} - {{ $availableMemory->technology }} - {{ $availableMemory->capacity }}
                </option>
              @endforeach
            </select>
          </td>
          @error('memories[{{ $index }}][id]')
            <p class="text-sm text-red-600 dark:text-rose-400">
              {{ $message }}
            </p>
          @enderror
          <td>
            <input type="number" name="memories[{{ $index }}][quantity]" class="block py-2 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer text-center" min="1" value="{{ $memory['quantity'] }}" required>
          </td>
          <td class="flex justify-center items-center">
            <button type="button" class="remove-memory-btn bg-red-500 text-slate-50 px-2 py-1 rounded">
              <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
              </svg>
            </button>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div> --}}


<div class="my-6">
  <label for="memories" class="block text-gray-700 dark:text-slate-50">Memories</label>
  <!-- <select name="memories[]" id="memories" class="select--control sm:w-80 md:w-60 p-2 mt-1 block w-full">
      @foreach ($memories as $memory)
          <option value="{{ $memory->id }}">
            {{ $memory->serial }} - {{ $memory->technology }} - {{ $memory->capacity }}
          </option>
      @endforeach
  </select> -->
  <select id="memory" class="select--control sm:w-80 md:w-60 p-2 mt-1 block w-full">
    <option value="">Seleccionar</option>
      @foreach ($memories as $memory)
          <option value="{{ $memory->id }}">
            {{ $memory->serial }} - {{ $memory->technology }} - {{ $memory->capacity }}
          </option>
      @endforeach
  </select>
  <button type="button" id="add-memory" class="mt-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add Memory</button>
  @error('memories')
      <div class="text-red-500 text-sm">{{ $message }}</div>
  @enderror
</div>
<div id="selected-memories" class="mb-4"></div>
<!-- <div class="mb-4">
  <label for="quantity_mem" class="block text-gray-700 dark:text-slate-50">Quantity</label>
  @foreach ($memories as $memory)
      <input type="number" name="quantity_mem[{{ $memory->id }}]" id="quantity_mem_{{ $memory->id }}" class="mt-1 block w-full dark:text-slate-50 dark:bg-slate-800" placeholder="Quantity for {{ $memory->type }}">
      @error('quantity_mem.' . $memory->id)
          <div class="text-red-500 text-sm">{{ $message }}</div>
      @enderror
  @endforeach
</div> -->