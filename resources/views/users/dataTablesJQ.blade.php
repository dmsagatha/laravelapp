<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
      {{ __('DataTables.Net') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="min-w-full mx-auto sm:px-6 lg:px-8">
      <div class="bg-slate-50 dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="px-6 text-slate-900 dark:text-slate-100">
          <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="px-4 py-5 mx-auto text-center max-w-7xl sm:px-6 lg:py-2 lg:px-8">
              <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-slate-50 sm:text-4xl">
                <span class="block">
                  <a href="https://datatables.net/extensions/responsive/examples/initialisation/default.html" target="_blank">DataTables.Net con Tailwind CSS</a>
                </span>
              </h2>
              <span class="block mt-4">Este ejemplo usa
                <a href="https://tailwindcss.com/" target="_new" class="text-indigo-600" alt="Tailwind CSS">
                  Tailwind CSS
                </a>
              </span>
            </div>
          </div>

          <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table id="dtTheme" class="display compact nowrap row-border stripe table" style="width:100%">
              <thead>
                <tr>
                  <th rowspan="2" width="1%">N°</th>
                  <th colspan="2">Datos Personales</th>
                  <th colspan="2">Contacto</th>
                  <th rowspan="2">Acciones</th>
                </tr>
                <tr>
                  <th>Nombre</th>
                  <th>Correo Electrónico</th>
                  <th>País</th>
                  <th>Dirección</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $key => $item)
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <th>{{ $item->name }}</th>
                    <td>{{ $item->email }}</td>
                    <th>{{ $item->country }}</th>
                    <td>{{ $item->address }}</td>
                    <td>
                      <a href="#"
                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                      <a href="#"
                        class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Eliminar</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>N°</th>
                  <th>Nombre</th>
                  <th>Correo Electrónico</th>
                  <th>País</th>
                  <th>Dirección</th>
                  <th>Acciones</th>
                </tr>
              </tfoot>
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
      // Inicialización predeterminada
      /* DataTable.defaults.responsive = true;      
      new DataTable('#dtTheme'); */

      /* language: {
        url: "{{ asset('plugins/dataTables/Spanish.json') }}"
      }, */

      // 2da. opción
      let table = new DataTable('#dtTheme', {
        responsive: true,
        lengthMenu: [[10, 15, 25, 50, 100, -1], [10, 15, 25, 50, 100, "Todos"]],
        pageLength: 25,
        processing: true,
        language: {
          url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-MX.json'
        }
      });

      // 3ra. opción
      /* new DataTable('#dtTheme', {
        destroy: true,
        responsive: true,
        lengthMenu: [[10, 15, 25, 50, 100, -1], [10, 15, 25, 50, 100, "Todos"]],
        pageLength: 25,
        processing: true,
        language: {
          search: 'Buscar',
          url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-MX.json'
        }
      }); */
    </script>
  @endpush
</x-app-layout>