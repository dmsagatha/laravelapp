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
    
    {{-- Memorias adicionales --}}
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const container = document.getElementById("memory-fields");
        const addMemoryBtn = document.getElementById("add-memory-btn");
        const memoryTable = document.getElementById("memory-table");
        const memoryList = document.getElementById("memory-list");
    
        // Ocultar la tabla si no hay memorias cargadas
        function checkTableVisibility() {
          if (memoryList.children.length === 0) {
            memoryTable.classList.add("hidden");
          } else {
            memoryTable.classList.remove("hidden");
          }
        }
        checkTableVisibility();
    
        addMemoryBtn.addEventListener("click", function () {
          console.log("🟡 Botón de agregar memoria clickeado");
    
          const index = memoryList.children.length;
          const memoryField = document.createElement("tr");
          memoryField.classList.add("memory-item");
    
          memoryField.innerHTML = `
            <td>
              <select name="memories[${index}][id]" class="memory-select select--control sm:w-80 md:w-60 p-2">
                <option value="">Seleccionar</option>
                @foreach($memories as $memory)
                  <option value="{{ $memory->id }}">
                    {{ $memory->serial }} - {{ $memory->technology }} - {{ $memory->capacity }}
                  </option>
                @endforeach
              </select>
            </td>
            <td>
              <input type="number" name="memories[${index}][quantity]" class="block py-2 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer text-center" min="1">
            </td>
            <td class="flex justify-center items-center">
              <button type="button" class="remove-memory-btn bg-red-500 text-white px-2 py-1 rounded">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                </svg>
              </button>
            </td>
          `;
          memoryList.appendChild(memoryField);
          checkTableVisibility();
        });
    
        // Validación de referencias duplicadas
        container.addEventListener("change", function (event) {
          if (event.target.classList.contains("memory-select")) {
            const selectedValues = Array.from(document.querySelectorAll(".memory-select"))
              .map(select => select.value)
              .filter(value => value !== "");
    
            const uniqueValues = new Set(selectedValues);
    
            if (selectedValues.length !== uniqueValues.size) {
              Swal.fire({
                icon: "warning",
                title: "Referencia duplicada",
                text: "Esta referencia ya ha sido seleccionada. Por favor, elegir otra.",
                confirmButtonColor: "#d33",
              });
    
              // Restablecer la selección
              event.target.value = "";
            }
          }
        });
    
        // Eliminación de memorias
        container.addEventListener("click", function (event) {
          if (event.target.closest(".remove-memory-btn")) {
            console.log("🔴 Botón de eliminar clickeado");
    
            let memoryField = event.target.closest("tr");
    
            if (memoryField) {
              console.log("✅ Elemento encontrado para eliminar:", memoryField);
    
              const selectInput = memoryField.querySelector('select[name^="memories"][name$="[id]"]');
    
              if (selectInput && selectInput.value) {
                console.log("🔵 Memoria existente detectada con ID:", selectInput.value);
    
                memoryField.style.display = "none"; // Ocultar visualmente en edición
    
                let deleteInput = document.querySelector(`input[name="memories_to_delete[]"][value="${selectInput.value}"]`);
    
                if (!deleteInput) {
                  deleteInput = document.createElement("input");
                  deleteInput.type = "hidden";
                  deleteInput.name = "memories_to_delete[]";
                  deleteInput.value = selectInput.value;
                  container.appendChild(deleteInput);
                  console.log("🟢 Input hidden creado para marcar la memoria como eliminada:", deleteInput);
                }
              } else {
                console.log("🟠 Memoria nueva eliminada completamente del DOM");
                memoryField.remove();
              }
            }
    
            // Revisar si la tabla debe ocultarse
            setTimeout(checkTableVisibility, 200);
          }
        });
      });
    </script>
  @endpush
</x-app-layout>