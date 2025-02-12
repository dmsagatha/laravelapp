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
            {{ isset($processor->id) ? 'Actualizar - ' : 'Crear - ' }} Procesadores - Selects dependientes
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
      <form action="{{ isset($processor->id) ? route('processors.update', $processor) : route('processors.store') }}" method="POST">
          @csrf
          @if(isset($processor->id))
              @method('PUT')
          @endif

        @include('admin.processors.form')

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
    <script>
      document.getElementById('add-memory').addEventListener('click', function () {
          const selectedMemoriesContainer = document.querySelector('#selected-memories tbody');
          const memoryRow = document.createElement('tr');
      
          memoryRow.innerHTML = `
              <td class="px-4 py-2">
                <select name="memories[]" class="select--control sm:w-80 md:w-60 p-2">
                  <option value="">Seleccionar</option>
                  @foreach ($memories as $memory)
                    <option value="{{ $memory->id }}">
                      {{ $memory->serial }} - {{ $memory->technology }} - {{ $memory->capacity }}
                    </option>
                  @endforeach
                </select>
              </td>
              <td class="px-4 py-2">
                <input type="number" name="quantity_mem[]" class="block py-2 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer text-center" placeholder="Quantity">
              </td>
              <td class="px-4 py-2">
                <button type="button" class="remove-memory bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                  Borrar Crear
                </button>
              </td>
          `;
      
          selectedMemoriesContainer.appendChild(memoryRow);
          document.getElementById('selected-memories').style.display = 'block';
      
          memoryRow.querySelector('.remove-memory').addEventListener('click', function () {
              memoryRow.remove();
              if (selectedMemoriesContainer.children.length === 0) {
                  document.getElementById('selected-memories').style.display = 'none';
              }
          });
      });
    </script>

    {{-- Seleccionar el Tipo del Modelo del Prototipo --}}
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const modelTypeSelect = document.getElementById('model_type');
        const referenceSelect = document.getElementById('reference');
        const form = referenceSelect.closest('form'); // Obtiene el formulario padre
        const selectedPrototypeId = referenceSelect.getAttribute('data-selected'); // Para edición
    
        // Función para cargar referencias basadas en el model_type
        function loadReferences(modelType, selectedReference = null) {
          referenceSelect.innerHTML = '<option value="">Seleccionar Referencia</option>';
          referenceSelect.disabled = true;
    
          if (modelType) {
            fetch(`/procesadores/prototipos/tipo?model_type=${encodeURIComponent(modelType)}`)
              .then(response => response.json())
              .then(data => {
                console.log('Datos recibidos:', data); // Verificar qué devuelve la API

                data.forEach(prototype => {
                  const option = document.createElement('option');
                  option.value = prototype.id; // Asegurar que el ID sea correcto
                  option.textContent = `${prototype.reference} - ${prototype.brand}`;
                  
                  if (selectedReference && prototype.id == selectedReference) {
                    option.selected = true;
                  }
                  referenceSelect.appendChild(option);
                });
    
                referenceSelect.disabled = false;
              })
              .catch(error => console.error('Error al obtener referencias:', error));
          }
        }
    
        // Evento cuando cambia el tipo de modelo
        modelTypeSelect.addEventListener('change', function () {
          loadReferences(modelTypeSelect.value);
        });
    
        // En edición, cargar automáticamente las referencias
        if (selectedPrototypeId) {
          loadReferences(modelTypeSelect.value, selectedPrototypeId);
        }
    
        // Habilitar el select antes de enviar el formulario
        form.addEventListener('submit', function (event) {
          if (!referenceSelect.value) {
            event.preventDefault();
            alert('Por favor selecciona una referencia de modelo antes de enviar el formulario.');
            return;
          }
    
          referenceSelect.disabled = false; // Asegurar que se envíe el valor
          console.log('Enviando prototype_id:', referenceSelect.value);
        });
      });
    </script>

    {{-- Manejo del Service Tag, en proceso de baja y el formato de la MAC --}}
    <script>
      document.querySelector('#inputServicetag').addEventListener('change', function() {
        this.value = this.value.replace(/\s/gi, '');
      });

      document.getElementById('inputMac').addEventListener('change', macFormat);
      document.getElementById('inputMac').addEventListener('keyup', macFormat);

      function macFormat(e) {
        this.value =
          (this.value.toUpperCase()
            .replace(/[^A-F0-9]/g, '')
            .match(/.{1,2}/g) || [])
          .join(':');
      }
    </script>
  @endpush
</x-app-layout>