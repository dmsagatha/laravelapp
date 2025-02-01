<div class="grid grid-cols-6 gap-x-10 gap-y-8">
  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative z-0 group mt-3">
      <x-input name="mac" id="inputMac" value="{{ old('mac', $processor->mac) }}" autocomplete="mac" autofocus />
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

  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative form-group">
      <label for="prototype_id" class="select--label required">Prototipos</label>
      <select name="prototype_id" id="prototype_id" class="select--control">
        <option selected value="">Seleccionar</option>
        @foreach ($prototypes as $id => $label)
          <option value="{{ $id }}" @selected(old('prototype_id', $processor->prototype->id ?? '') == $id)>
          {{-- <option value="{{ $id }}" @selected(old('prototype_id', $processor->prototype->id ?? $processor->prototype_id) == $id)> --}}
            {{ $label }}
          </option>
        @endforeach
      </select>
      @error('prototype_id')
        <p class="text-sm text-red-600 dark:text-rose-400">
          {{ $message }}
        </p>
      @enderror
    </div>
  </div>
</div>

<div id="memory-fields" class="max-w-lg mt-5 space-y-4">
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
            <input type="number" name="memories[{{ $index }}][quantity]]" class="block py-2 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer text-center" min="1" value="{{ $memory['quantity'] }}" required>
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
</div>