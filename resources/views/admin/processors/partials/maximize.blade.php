<div class="max-w-full mt-10">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 justify-center items-center">
    {{-- Memorias adicionales --}}
    <div class="md:col-span-1 rounded-lg">
      <table class="table-auto w-full">
        <caption class="font-bold py-2">Memorias RAM adicionales</caption>
        <thead>
          <tr>
            <th class="text-xs">Memorias</th>
            <th class="text-xs">Cantidad</th>
            <th class="text-sm">Acciones</th>
          </tr>
        </thead>
        <tbody>
          @if ($processor->memories->isEmpty())
            <tr>
              <td>
                <select name="memories[]" class="select--control sm:w-80 md:w-60 p-2 fieldDouble">
                  <option value="">Seleccionar</option>
                  @foreach ($memories as $memory)
                    <option value="{{ $memory->id }}"
                      {{ collect(old('memories'))->contains($memory->id) ? 'selected' : '' }}>
                      {{ $memory->serial }} - {{ $memory->technology }} - {{ $memory->velocity }} - {{ $memory->capacity }}
                    </option>
                  @endforeach
                </select>
              </td>
              <td>
                <input type="number" name="quantities_addmem[]" class="block py-2 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer text-center" min="1" value="{{ $memory['quantity'] }}" required>
              </td>
              <td class="inline">
                <button type="button" class="addBtn inline-flex items-center justify-center px-2 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-sm text-slate-50 hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring-0 focus:ring-green-200 active:bg-green-600 disabled:opacity-25 transition">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                  </svg>
                </button>
                <button type="button" class="removeBtn inline-flex items-center justify-center px-2 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-sm text-slate-50 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring-0 focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                  </svg>
                </button>
                
                {{-- <x-form.btn-green class="addBtn" iconFa="fa-plus text-center mr-0" />
                <x-form.btn-red class="removeBtn" iconFa="fa-minus text-center mr-0" /> --}}
              </td>
            </tr>
          @else
            @foreach ($processor->memories as $memory_processor)
              <tr>
                <td>
                  <select name="memories[]" class="select--control sm:w-80 md:w-60 p-2 fieldDouble">
                    <option value="">Seleccionar</option>
                    @foreach ($memories as $memory)
                      <option value="{{ $memory->id }}" @if ($memory_processor->id == $memory->id) selected @endif>
                        {{ $memory->serial }} - {{ $memory->technology }} - {{ $memory->velocity }} - {{ $memory->capacity }}
                      </option>
                    @endforeach
                  </select>
                </td>
                <td>
                  <input class="form--control w-16 sm:w-20 md:w-16 text-center" name="quantities_addmem[]"
                    type="number"
                    value="{{ old('quantities_addmem[]', $memory_processor->pivot->quantity_addmem) }}">
                </td>
                <td class="inline">
                  <button type="button" class="addBtn inline-flex items-center justify-center px-2 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-sm text-slate-50 hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring-0 focus:ring-green-200 active:bg-green-600 disabled:opacity-25 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                  </button>
                  <button type="button" class="removeBtn inline-flex items-center justify-center px-2 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-sm text-slate-50 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring-0 focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                    </svg>
                  </button>
                  {{-- <x-form.btn-green class="addBtn" iconFa="fa-plus text-center mr-0" />
                  <x-form.btn-red class="removeBtn" iconFa="fa-minus text-center mr-0" /> --}}
                </td>
              </tr>
            @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>