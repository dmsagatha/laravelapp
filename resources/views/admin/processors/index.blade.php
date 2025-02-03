<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
      {{ __('Procesadores') }}
    </h2>
  </x-slot>

  <div class="flow-root mx-auto w-full max-w-7xl sm:px-1 sm:py-2 my-6">
    <div class="text-slate-900 bg-slate-50 dark:text-slate-100 dark:bg-slate-800 p-4 m-2 sm:p-4 shadow rounded">
      <div class="relative overflow-x-auto w-full mx-auto text-center p-4 m-4 sm:px-6 lg:py-2 lg:px-8">
        <h2 class="text-xl font-extrabold tracking-tight text-slate-900 dark:text-slate-50 sm:text-2xl">
          <span class="block">
            <a href="https://datatables.net/extensions/responsive/examples/initialisation/default.html" target="_blank">
              CRUD e Importar Procesadores y Memorias RAM - <br>
              Relación Muchos a Muchos
            </a>
          </span>
        </h2>
      </div>

      {{-- Filtros, Crear --}}
      <div class="flex justify-between flex-wrap flex-grow">
        {{-- Filtros --}}
        <div class="flex items-center p-2 space-x-2 text-slate-800 dark:text-slate-50"></div>

        {{-- Crear --}}
        <div class="flex items-center p-2 space-x-2 text-slate-800 dark:text-slate-50">
          <div class="row">
            <a href="{{ route('processors.create') }}" class="relative inline-flex items-center justify-center p-2 mr-2 mb-2 text-blue-600 border border-blue-500 hover:bg-blue-500 hover:text-slate-50 active:bg-blue-600 font-medium rounded-lg outline-none focus:outline-none ease-linear transition-all duration-150">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
              </svg>
            </a>
          </div>
        </div>
      </div>
      
      {{-- Importar y Selects Dependientes (JavaScript) --}}
      <div class="mx-2 flex flex-wrap">
        <!-- Card 1 -->
        <div class="w-full px-2 md:w-3/5">
          <div class="h-full rounded-xl p-2 border-slate-300 shadow-sm transition-all hover:shadow-md shadow-slate-400 dark:shadow-slate-400 sm:p-7 lg:px-6 xl:px-9">
            <span class="block text-center py-4">Guía:
              <a href="https://www.youtube.com/watch?v=Q2AUH9w9XaA" target="_new"
                class="font-bold text-lg text-indigo-500" alt="Tailwind CSS">
                Laravel Excel Import to Database with Errors and Validation Handling
              </a>
            </span>
            <div class="text-center">
              <form action="{{ route('processors.import') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="file" id="import_file" name="import_file" required>
  
                <button type="submit" class="bg-indigo-600 dark:bg-indigo-500 text-slate-50 font-medium hover:bg-indigo-500 dark:hover:bg-indigo-600 my-2 px-4 py-2 rounded-md">
                  Importar
                </button>
              </form>
              <span class="block text-center text-sm py-2">
                (Archivo de ejemplo: public/importar/processors.xlsx) - <br>
                Intentar subir varias veces el mismo archivo y verá los resultados
              </span>
            </div>
          </div>
        </div>
        
        <!-- Card 2 -->
        <div class="w-full px-2 md:w-2/5">
          <div class="h-full rounded-xl p-2 border-slate-300 shadow-sm transition-all hover:shadow-md shadow-slate-400 dark:shadow-slate-400 sm:p-7 lg:px-6 xl:px-9">
            <div class="flex items-center mb-3">
              <h2 class="text-center text-slate-50 dark:text-slate-50 text-lg font-semibold">
                Selects Dependientes (JavaScript)
              </h2>
            </div>
            <div class="py-4">
              <form>
                <div class="grid grid-cols-6 gap-x-3 gap-y-8">
                  <div class="col-span-6 sm:col-span-3">
                    <div class="relative form-group">
                      <x-select-label name="model_type" id="model_type" label="Tipo de Modelo">
                        @foreach (\App\Models\Prototype::MODEL_TYPE_SELECT as $value => $label)
                          <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                      </x-select-label>
                    </div>
                  </div>
  
                  <div class="col-span-6 sm:col-span-3">
                    <div class="relative form-group">
                      <x-select-label name="reference" id="reference" label="Referencia de Modelo" disabled>
                        <option value="">Seleccionar Referencia</option>
                      </x-select-label>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      {{-- Listado --}}
      <div class="relative overflow-x-auto max-w-6xl mx-auto p-4 m-4 shadow-sm shadow-slate-300 sm:rounded-lg">
        @include('partials.failures')

        @include('admin.processors._table')
      </div>
    </div>
  </div>

  @include('partials.dataTables')

  @push('scripts')
    {{-- Seleccionar el Tipo del Modelo del Prototipo --}}
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const modelTypeSelect = document.getElementById('model_type');
        const referenceSelect = document.getElementById('reference');

        modelTypeSelect.addEventListener('change', function () {
          const modelType = modelTypeSelect.value;
  
          // Limpia las opciones actuales del select de referencias
          referenceSelect.innerHTML = '<option value="">Seleccionar Referencia</option>';
          referenceSelect.disabled = true;

          if (modelType) {
            fetch(`/procesadores/prototipos/tipo?model_type=${encodeURIComponent(modelType)}`)
              .then(response => {
                if (!response.ok) {
                  throw new Error('La respuesta de la red no fue correcta');
                }
                return response.json();
              })
              .then(data => {
                // Agrega las nuevas opciones al select de referencias
                Object.entries(data).forEach(([id, reference]) => {
                  const option = document.createElement('option');
                  option.value = id;
                  option.textContent = reference;
                  referenceSelect.appendChild(option);
                });

                referenceSelect.disabled = false;
              })
              .catch(error => {
                console.error('Error al obtener referencias:', error);
              });
          }
        });
      });
    </script>
  @endpush
</x-app-layout>