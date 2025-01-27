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

<div id="memory-section">
  <label>Memorias:</label>
  <button type="button" id="add-memory-btn" class="bg-blue-500 text-white px-4 py-2 rounded">
    Adicionar Memoria
  </button>
  <div id="memory-fields" class="space-y-4">
      @foreach($selectedMemories as $index => $memory)
      <div class="flex items-center space-x-4">
          <div>
              <label for="memories[{{ $index }}][id]">Memory:</label>
              <select name="memories[{{ $index }}][id]" class="border border-gray-300 rounded p-2" required>
                  @foreach($memories as $availableMemory)
                      <option value="{{ $availableMemory->id }}" {{ $memory['id'] == $availableMemory->id ? 'selected' : '' }}>
                          {{ $availableMemory->serial }} - {{ $availableMemory->capacity }}GB
                      </option>
                  @endforeach
              </select>
          </div>
          <div>
              <label for="memories[{{ $index }}][quantity]">Quantity:</label>
              <input type="number" name="memories[{{ $index }}][quantity]]" class="border border-gray-300 rounded p-2"
                  min="1" value="{{ $memory['quantity'] }}" required>
          </div>
          <button type="button" class="remove-memory-btn bg-red-500 text-white px-2 py-1 rounded">Remove</button>
      </div>
      @endforeach
  </div>
</div>