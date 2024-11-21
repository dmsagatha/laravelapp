<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
      {{ __('Procesadores') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="flow-root mx-auto w-full md:w-full lg:w-4/5 sm:px-6 lg:px-8">
      <div class="bg-slate-50 dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="px-6 text-slate-900 dark:text-slate-100">
          <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="px-4 py-5 mx-auto text-center max-w-7xl sm:px-6 lg:py-2 lg:px-8">
              <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-slate-50 sm:text-3xl">
                <span class="block">
                  <a href="https://datatables.net/extensions/responsive/examples/initialisation/default.html"
                    target="_blank">Importar Procesadores y Memorias RAM</a>
                </span>
              </h2>

              <form action="{{ route('processors.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- <input type="file" id="import_file" name="import_file" accept=".xls" required> --}}
                <input type="file" id="import_file" name="import_file" required>
                
                <button type="submit" class="ml-3 bg-indigo-600 dark:bg-indigo-500 text-white font-medium hover:bg-indigo-500 dark:hover:bg-indigo-600 px-4 py-2 rounded-md">
                  Importar
                </button>
              </form>
            </div>
          </div>

          <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            @if (isset($errors) && $errors->any())
              <div>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </div>                
            @endif

            @include('partials.failures')
            
            <table id="dtTheme" class="display compact nowrap row-border stripe" style="width:100%">
              <thead>
                <tr>
                  <th width="1%">N°</th>
                  <th>Usuario</th>
                  <th>MAC</th>
                  <th>Service Tag</th>
                  <th>Memorias</th>
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
                      @foreach ($item->addMemories as $key => $data)
                        <li>{{ $data->brand }} - {{ $data->technology }} - {{ $data->velocity }} - {{ $data->capacity }} - SLUG: {{ $data->slug }}</li>
                      @endforeach
                    </td>
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
  @endpush
</x-app-layout>