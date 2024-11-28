<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
      {{ __('Memorias') }}
    </h2>
  </x-slot>

  <div class="flow-root w-full mx-auto md:w-full lg:w-4/5 shadow px-4 py-4 rounded sm:px-1 sm:py-2 bg-slate-50 dark:bg-slate-800">
    {{-- Títulos --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <div class="px-4 py-5 mx-auto text-center max-w-7xl sm:px-6 lg:py-2 lg:px-8">
        <h2 class="text-2xl font-extrabold tracking-tight text-slate-900 dark:text-slate-50 sm:text-3xl">
          <span class="block">
            <a href="#" target="_blank">
              Memorias - Selects dinámicos con Constantes
            </a>
          </span>
        </h2>
        
        @if (session()->has('status'))
          <div class="flex justify-center items-center">
            <p class="ml-3 text-lg font-bold text-green-600 dark:text-slate-300">{{ session()->get('status') }}</p>
          </div>
        @endif
      </div>
    </div>
    
    <div class="flex justify-between flex-wrap flex-grow">
      {{-- Filtros --}}
      <div class="flex items-center px-2 py-3 space-x-2 text-slate-800 dark:text-slate-50"></div>

      {{-- Crear --}}
      <div class="flex items-center px-2 py-3 space-x-2 text-slate-800 dark:text-slate-50">
        <div class="row">
          <a href="{{ route('memories.create') }}" class="relative inline-flex items-center justify-center p-2 mr-2 mb-2 text-blue-600 border border-blue-500 hover:bg-blue-500 hover:text-slate-50 active:bg-blue-600 font-medium rounded-lg outline-none focus:outline-none ease-linear transition-all duration-150">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
          </a>
        </div>
      </div>
    </div>

    {{-- Listados --}}
    <div class="inline-block w-full overflow-x-auto p-4 shadow-md sm:rounded-lg">
      @include('partials.failures')
      
      @if ($memories->count())
        <table id="dtTheme" class="display compact nowrap row-border stripe" style="width:100%">
          <thead>
            <tr>
              <th width="1%">N°</th>
              <th>Acciones</th>
              <th>Serial</th>
              <th>Capacidad</th>
              <th>Tecnología</th>
              <th>Velocidad</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($memories as $key => $item)
              <tr>
                <td style="text-align: center;">{{ $key + 1 }}</td>
                <td>
                  <div class="flex items-stretch justify-center">
                    <a href="{{ route('memories.edit', $item) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-blue-400 dark:hover:text-slate-200">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 30 30" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                      </svg>                    
                    </a>
                   - Eliminar
                  </div>
                </td>
                <td class="text-center">{{ $item->serial }}</td>
                <td class="text-center">
                  {{ App\Models\Memory::CAPACITY_SELECT[$item->capacity] }}
                </td>
                <td class="text-center">
                  {{ App\Models\Memory::TECHNOLOGY_SELECT[$item->technology] }}
                </td>
                <td class="text-center">
                  {{ $item->velocity }} MHz
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @else
        <div class="flex justify-center px-4 mt-4 mb-2 space-x-4 text-slate-800 dark:text-slate-300">
          No hay registros creados
        </div>
      @endif
    </div>
  </div>

  {{-- <div class="py-12">
    <div class="flow-root mx-auto w-full md:w-full lg:w-4/5 sm:px-6 lg:px-8">
      <div class="bg-slate-50 dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="px-6 text-slate-900 dark:text-slate-100">
          <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="px-4 py-5 mx-auto text-center max-w-7xl sm:px-6 lg:py-2 lg:px-8">
              <h2 class="text-2xl font-extrabold tracking-tight text-slate-900 dark:text-slate-50 sm:text-3xl">
                <span class="block">
                  <a href="#" target="_blank">
                    Memorias - Selects dinámicos con Constantes
                  </a>
                </span>
              </h2>
            </div>
          </div>

          <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            @include('partials.failures')
            
            @if ($memories->count())
              <table id="dtTheme" class="display compact nowrap row-border stripe" style="width:100%">
                <thead>
                  <tr>
                    <th width="1%">N°</th>
                    <th>Serial</th>
                    <th>Capacidad</th>
                    <th>Tipo</th>
                    <th>Velocidad</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($memories as $key => $item)
                    <tr>
                      <td style="text-align: center;">{{ $key + 1 }}</td>
                      <td>{{ $item->serial }}</td>
                      <td class="text-center">
                        {{ App\Models\Memory::CAPACITY_SELECT[$item->capacity] }}
                      </td>
                      <td class="text-center">
                        {{ App\Models\Memory::TYPE_SELECT[$item->type] }}
                      </td>
                      <td class="text-center">
                        {{ $item->velocity }} MHz
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @else
              <div class="flex justify-center px-4 mt-4 mb-2 space-x-4 text-slate-800 dark:text-slate-300">
                No hay registros creados
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div> --}}

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
  @endpush
</x-app-layout>