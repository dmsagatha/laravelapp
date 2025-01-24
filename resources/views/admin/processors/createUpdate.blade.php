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
            Procesadores - Selects dependencies
          </span>
        </h2>
      </div>
    </div>

    <div class="p-10">
      <form action="{{ route('processors.store') }}" method="POST">
        @csrf

        @include('admin.processors._fields')

        <div class="py-3 bg-slate-50 dark:bg-slate-800 text-center space-x-2">
          <button type="submit" class="w-36 inline-flex items-center justify-center bg-green-600 border border-transparent rounded-md font-medium p-2 mr-2 mb-2 text-center text-sm text-white hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring-0 focus:ring-green-200 active:bg-green-600 disabled:opacity-25 transition">
            {{ isset($processor->id) ? 'Actualizar' : 'Crear' }}
          </button>
          <button class="w-36 inline-flex items-center justify-center bg-red-600 border border-transparent rounded-md font-medium p-2 mr-2 mb-2 text-center text-sm text-white hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring-0 focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition">
            <a href="{{ route('processors.index') }}">Cancelar</a>
          </button>
        </div>
      </form>
    </div>
  </div>

  @push('scripts')
    <script>
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
    </script>
  @endpush
</x-app-layout>