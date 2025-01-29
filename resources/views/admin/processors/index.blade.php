<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
      {{ __('Procesadores') }}
    </h2>
  </x-slot>

  <div class="flow-root mx-auto w-full max-w-7xl">
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
      
      {{-- Importar y Selects Dependientes (JavaScript) --}}
      <div class="mx-2 flex flex-wrap">
        <!-- card 1 -->
        <div class="w-full px-2 md:w-3/5">
          <div class="h-full rounded-xl py-2 px-2 border-slate-300 shadow-sm transition-all hover:shadow-md shadow-slate-400 sm:p-9 lg:px-6 xl:px-9">
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
        
        <!-- card 2 -->
        <div class="w-full px-2 md:w-2/5">
          <div class="h-full rounded-xl py-2 px-2 border-slate-300 shadow-sm transition-all hover:shadow-md shadow-slate-400 sm:p-9 lg:px-6 xl:px-9">
            <div class="flex items-center mb-3">
              <h2 class="text-slate-50 dark:text-slate-50 text-lg font-medium">
                Selects Dependientes (JavaScript)
              </h2>
            </div>
            <div>
              <form>
                <div class="grid grid-cols-6 gap-x-10 gap-y-8">
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

      {{-- Filtros, Crear --}}
      <div class="flex justify-between flex-wrap flex-grow">
        {{-- Filtros --}}
        <div class="flex items-center px-2 py-3 space-x-2 text-slate-800 dark:text-slate-50"></div>

        {{-- Crear --}}
        <div class="flex items-center px-2 py-3 space-x-2 text-slate-800 dark:text-slate-50">
          <div class="row">
            <a href="{{ route('processors.create') }}"
              class="relative inline-flex items-center justify-center p-2 mr-2 mb-2 text-blue-600 border border-blue-500 hover:bg-blue-500 hover:text-slate-50 active:bg-blue-600 font-medium rounded-lg outline-none focus:outline-none ease-linear transition-all duration-150">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
              </svg>
            </a>
          </div>
        </div>
      </div>

      {{-- Listado --}}
      <div class="relative overflow-x-auto max-w-6xl mx-auto p-4 m-4 shadow-sm shadow-slate-300 sm:rounded-lg">
        @include('partials.failures')

        <table id="dtTheme" class="display compact nowrap row-border stripe">
          <thead>
            <tr>
              <th width="1%">N°</th>
              <th>ID</th>
              <th>Acciones</th>
              <th>Usuario</th>
              <th>MAC</th>
              <th>Service Tag</th>
              <th>Memorias</th>
              <th>Prototipos</th>
              <th>Memorias Adicionales</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($processors as $key => $item)
              <tr>
                <td style="text-align: center;">{{ $key + 1 }}</td>
                <td>{{ $item->id }}</td>
                <td>
                  <div class="flex items-stretch justify-center">
                    <a href="{{ route('processors.edit', $item) }}">
                      <svg class="text-blue-500 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                        <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                        <line x1="16" y1="5" x2="19" y2="8" />
                      </svg>
                    </a>
                    <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">
                      <svg class="text-red-500 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <polyline points="3 6 5 6 21 6" />
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                        <line x1="10" y1="11" x2="10" y2="17" />
                        <line x1="14" y1="11" x2="14" y2="17" />
                      </svg>
                    </a>
                  </div>
                </td>
                <th>{{ $item->user->name }}</th>
                <th>{{ $item->mac }}</th>
                <td>{{ $item->servicetag }}</td>
                <td>
                  @if(!$item->memories->isEmpty())
                    @foreach($item->memories as $memory)
                      {{ $memory->serial }} - {{ $memory->capacity }} - {{ $memory->technology }} x {{
                      $memory->pivot->quantity }}<br>
                    @endforeach
                  @endif
                </td>
                <td>{{ $item->prototype->reference }}</td>
                <td class="text-xs">
                  @if(!$item->addMemories->isEmpty())
                    <p><span class="underline">Adicionales:</span></p>
                    @foreach($item->addMemories as $addMemory)
                      {{ $addMemory->brand }} - {{ $addMemory->technology }} - {{ $addMemory->velocity }} MHz - {{
                      $addMemory->capacity }} x {{ $addMemory->pivot->quantity_addmem }}<br>
                    @endforeach
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  @push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.css">
  @endpush

  @push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.dataTables.js"></script>

    {{-- DataTables --}}
    <script>
      let table = new DataTable('#dtTheme', {
          responsive: true,
          lengthMenu: [
            [10, 15, 25, 50, 100, -1],
            [10, 15, 25, 50, 100, "Todos"]
          ],
          pageLength: 25,
          processing: true,
          language: {
            url: 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/es-ES.json'
          }
        });
    </script>

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