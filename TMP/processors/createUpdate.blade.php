<x-app-layout>
  @section('title', 'Procesadores - ' . ($processor->id ? 'Actualizar' : 'Crear'))

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
      {{ __('Procesadores') }}
    </h2>
  </x-slot>

  <div class="max-w-4xl mx-auto bg-slate-50 dark:bg-slate-800 rounded shadow-sm shadow-blue-600 my-12">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <div class="px-4 py-5 mx-auto text-center max-w-7xl sm:px-6 lg:py-2 lg:px-8">
        <h2 class="text-2xl font-extrabold tracking-tight text-slate-900 dark:text-slate-50 sm:text-3xl">
          <span class="block">
            @if (isset($processor->id))
              Actualizar - Procesadores - Selects dependientes
            @else
              Crear - Procesadores - Selects dependientes
            @endif
          </span>
        </h2>
      </div>

      @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
    </div>

    <div class="p-10">
      <form method="POST" action="{{ isset($processor->id) ? route('processors.update', $processor) : route('processors.store') }}">
        @csrf
        @if (isset($processor->id))
          @method('PUT')
        @endif

        @include('admin.processors._fields')

        <div class="py-3 bg-slate-50 dark:bg-slate-800 text-center space-x-2">
          <button type="submit" class="w-36 inline-flex items-center justify-center bg-green-600 border border-transparent rounded-md font-medium p-2 mr-2 mb-2 text-center text-sm text-slate-50 hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring-0 focus:ring-green-200 active:bg-green-600 disabled:opacity-25 transition">
            {{ isset($processor->id) ? 'Actualizar' : 'Crear' }}
          </button>
          <button class="w-36 inline-flex items-center justify-center bg-red-600 border border-transparent rounded-md font-medium p-2 mr-2 mb-2 text-center text-sm text-slate-50 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring-0 focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition">
            <a href="{{ route('processors.index') }}">Cancelar</a>
          </button>
        </div>
      </form>
    </div>
  </div>

  @push('scripts')
    {{-- <script src="{{ asset('js/dynamicSelection.js') }}"></script> --}}
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const container = document.getElementById("memory-fields");
        const addMemoryBtn = document.getElementById("add-memory-btn");

        container.addEventListener("click", function (event) {
          if (event.target.classList.contains("remove-memory-btn")) {
            console.log("🔴 Botón de eliminar clickeado");

            // Buscar la memoria en una fila `<tr>` si es una memoria guardada
            let memoryField = event.target.closest("tr") || event.target.closest(".memory-item") || event.target.closest(".flex");

            if (memoryField) {
              console.log("✅ Elemento encontrado para eliminar:", memoryField);

              const hiddenInput = memoryField.querySelector('input[name^="memories"][name$="[id]"]');
              if (hiddenInput && hiddenInput.value) {
                console.log("🔵 Memoria existente detectada con ID:", hiddenInput.value);

                memoryField.style.display = "none";

                let deleteInput = document.querySelector(`input[name="memories_to_delete[]"][value="${hiddenInput.value}"]`);
                if (!deleteInput) {
                  deleteInput = document.createElement("input");
                  deleteInput.type = "hidden";
                  deleteInput.name = "memories_to_delete[]";
                  deleteInput.value = hiddenInput.value;
                  container.appendChild(deleteInput);
                  console.log("🟢 Input hidden creado para marcar la memoria como eliminada:", deleteInput);
                }
              } else {
                console.log("🟠 Memoria nueva eliminada completamente del DOM");
                memoryField.remove();
              }
            } else {
              console.log("⚠️ No se encontró el contenedor de la memoria. Probando con `event.target.parentElement`...");
              console.log("📌 Parent Element:", event.target.parentElement);
            }
          }
        });

        addMemoryBtn.addEventListener("click", function () {
          console.log("🟡 Botón de agregar memoria clickeado");

          const index = container.children.length;

          const memoryField = document.createElement("div");
          memoryField.classList.add("memory-item", "flex", "items-center", "space-x-4");
          memoryField.innerHTML = `
                <div>
                    <label for="memories[${index}][id]">Memory:</label>
                    <select name="memories[${index}][id]" class="border border-gray-300 rounded p-2" required>
                        @foreach($memories as $memory)
                            <option value="{{ $memory->id }}">{{ $memory->serial }} - {{ $memory->capacity }}GB</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="memories[${index}][quantity]">Quantity:</label>
                    <input type="number" name="memories[${index}][quantity]" class="border border-gray-300 rounded p-2" min="1" required>
                </div>
                <button type="button" class="remove-memory-btn bg-red-500 text-white px-2 py-1 rounded">Remove</button>
            `;
          container.appendChild(memoryField);
        });
      });
    </script>

    {{-- <script>
      document.getElementById('add-memory-btn').addEventListener('click', function () {
        const container = document.getElementById('memory-fields');
        const index = container.children.length;
    
        const memoryField = document.createElement('div');
        memoryField.classList.add('flex', 'items-center', 'space-x-4');
        memoryField.innerHTML = `
          <td>
            <select name="memories[${index}][id]" class="select--control sm:w-80 md:w-60 p-2" required>
              <option value="">Seleccionar una</option>
              @foreach($memories as $memory)
                <option value="{{ $memory->id }}">
                  {{ $memory->serial }} - {{ $memory->technology }} - {{ $memory->capacity }}
                </option>
              @endforeach
            </select>
          </td>
          <td>
            <input type="number" name="memories[${index}][quantity]" class="block py-2 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer text-center" min="1" required>
          </td>
          <button type="button" class="remove-memory-btn bg-red-500 text-slate-50 px-2 py-1 rounded">Eliminar</button>
        `;
        container.appendChild(memoryField);
    
        // Agregar evento para eliminar memoria
        memoryField.querySelector('.remove-memory-btn').addEventListener('click', function () {
          memoryField.remove();
        });
      });
    </script> --}}

    {{-- <script>
      document.getElementById('add-memory-btn').addEventListener('click', function () {
        const container = document.getElementById('memory-fields');
        const index = container.children.length;

        // Crear nuevos campos dinámicamente
        const memoryField = document.createElement('div');
        memoryField.innerHTML = `
            <div>
                <label for="memories[${index}][id]">Memory:</label>
                <select name="memories[${index}][id]" required>
                    @foreach($memories as $memory)
                        <option value="{{ $memory->id }}">{{ $memory->serial }} - {{ $memory->capacity }}GB</option>
                    @endforeach
                </select>
                <label for="memories[${index}][quantity]">Quantity:</label>
                <input type="number" name="memories[${index}][quantity]" min="1" required>
            </div>
        `;
        container.appendChild(memoryField);
      });
    </script> --}}
    {{-- <script>
      document.addEventListener('DOMContentLoaded', () => {
          const addMemoryBtn = document.getElementById('add-memory-btn');
          const memoryList = document.getElementById('memory-list');
  
          // Memorias disponibles (esto se puede cargar dinámicamente desde el backend si es necesario)
          const memories = @json($memories); // Desde el controlador (memorias disponibles)
  
          // Lógica para agregar una memoria
          addMemoryBtn.addEventListener('click', () => {
              // Crear una nueva fila
              const row = document.createElement('tr');
  
              // Columna de selección de memoria
              const memoryCell = document.createElement('td');
              const memorySelect = document.createElement('select');
              memorySelect.name = 'memories[][id]';
              memorySelect.required = true;
  
              // Opciones del select
              const defaultOption = document.createElement('option');
              defaultOption.textContent = 'Seleccione una memoria';
              defaultOption.disabled = true;
              defaultOption.selected = true;
              memorySelect.appendChild(defaultOption);
  
              memories.forEach(memory => {
                  const option = document.createElement('option');
                  option.value = memory.id;
                  option.textContent = `${memory.serial} - ${memory.capacity} (${memory.technology})`;
                  memorySelect.appendChild(option);
              });
  
              memoryCell.appendChild(memorySelect);
              row.appendChild(memoryCell);
  
              // Columna para cantidad
              const quantityCell = document.createElement('td');
              const quantityInput = document.createElement('input');
              quantityInput.type = 'number';
              quantityInput.name = 'memories[][quantity]';
              quantityInput.min = 1;
              quantityInput.required = true;
              quantityCell.appendChild(quantityInput);
              row.appendChild(quantityCell);
  
              // Columna para eliminar
              const actionCell = document.createElement('td');
              const deleteBtn = document.createElement('button');
              deleteBtn.type = 'button';
              deleteBtn.textContent = 'Eliminar';
              deleteBtn.addEventListener('click', () => {
                  row.remove();
              });
              actionCell.appendChild(deleteBtn);
              row.appendChild(actionCell);
  
              // Agregar la fila a la tabla
              memoryList.appendChild(row);
              console.log(memoryList);
          });
      });
    </script> --}}
  @endpush
</x-app-layout>