<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
      {{ __('Procesadores') }}
    </h2>
  </x-slot>
  
  <div class="flow-root mx-auto w-full max-w-6xl">
    <div class="text-slate-900 bg-slate-50 dark:text-slate-100 dark:bg-slate-800 p-4 m-2 sm:p-4 shadow rounded">
      <div class="relative overflow-x-auto w-full mx-auto text-center p-4 m-4 sm:px-6 lg:py-2 lg:px-8">
        <h2 class="text-2xl font-extrabold tracking-tight text-slate-900 dark:text-slate-50 sm:text-3xl">
          <span class="block">
            <a href="https://datatables.net/extensions/responsive/examples/initialisation/default.html"
              target="_blank">
              Importar Procesadores y Memorias RAM - <br>
              Relación Muchos a Muchos
            </a>
          </span>
        </h2>
        <span class="block py-4">Guía: 
          <a href="https://www.youtube.com/watch?v=Q2AUH9w9XaA" target="_new" class="font-bold text-lg text-indigo-500" alt="Tailwind CSS">
            Laravel Excel Import to Database with Errors and Validation Handling
          </a>
        </span>

        <div>
          <form action="{{ route('processors.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <input type="file" id="import_file" name="import_file" required>
            
            <button type="submit" class="ml-3 bg-indigo-600 dark:bg-indigo-500 text-white font-medium hover:bg-indigo-500 dark:hover:bg-indigo-600 px-4 py-2 rounded-md">
              Importar
            </button>
          </form>
          <span class="block py-2">
            (Archivo de ejmplo: public/importar/processors.xlsx) - <br>
            Intentar subir varias veces el mismo archivo y verá los resultados
          </span>
        </div>

        <div>
          <h1 class="text-xl underline mt-5">Selects Dependientes</h1>

          <div class="flex justify-center items-center">
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
      
      <div class="relative overflow-x-auto max-w-5xl mx-auto p-4 m-4 shadow-sm shadow-slate-300 sm:rounded-lg">
        @include('partials.failures')

        <table id="dtTheme" class="display compact nowrap row-border stripe">
          <thead>
            <tr>
              <th width="1%">N°</th>
              <th>Usuario</th>
              <th>MAC</th>
              <th>Service Tag</th>
              <th>Memorias</th>
              <th>Prototipos</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($processors as $key => $item)
              <tr>
                <td style="text-align: center;">{{ $key + 1 }}</td>
                <th>{{ $item->user->name }}</th>
                <th>{{ $item->mac }}</th>
                <td>{{ $item->servicetag }}</td>
                <td class="text-xs">
                  @if(!$item->addMemories->isEmpty())
                    <p><span class="underline">Adicionales:</span></p>
                    @foreach($item->addMemories as $addMemory)
                      {{ $addMemory->brand }} - {{ $addMemory->technology }} - {{ $addMemory->velocity }} MHz - {{ $addMemory->capacity }} x {{ $addMemory->pivot->quantity_addmem }}<br>
                    @endforeach
                  @endif
                </td>
                <td>{{ $item->prototype->reference }}</td>
                <td>
                  <div class="flex items-stretch justify-center">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                    <a href="#"  class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Eliminar</a>
                  </div>
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
            fetch(`/procesadores/prototipos?model_type=${encodeURIComponent(modelType)}`)
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