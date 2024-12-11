<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
      {{ __('DataTables.Net') }}
    </h2>
  </x-slot>

  <div class="min-w-full mx-auto sm:px-6 lg:px-8 my-12">
    <div class="bg-slate-50 dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
      <div class="px-6 text-slate-900 dark:text-slate-100">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
          <div class="px-4 py-5 mx-auto text-center max-w-7xl sm:px-6 lg:py-2 lg:px-8">
            <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-slate-50 sm:text-3xl">
              <span class="block">
                <a href="https://datatables.net/extensions/responsive/examples/initialisation/default.html"
                  target="_blank">DataTables.Net Responsive con Tailwind CSS</a>
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
          {{-- Listado --}}
          <div class="p-4 mt-24 shadow-md sm:rounded-lg">
            @if ($users->count())
              @include('admin.users._table')
            @else
              <div class="flex justify-center items-center py-4 text-slate-700 dark:text-slate-200">
                No hay registros creados
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  @push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
  @endpush

  @push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>

    <script>
      // Inicialización predeterminada
        let table = new DataTable('#dtTheme', {
          responsive: true,
          lengthMenu: [[10, 15, 25, 50, 100, -1], [10, 15, 25, 50, 100, "Todos"]],
          pageLength: 25,
          processing: true,
          language: {
            url: 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/es-ES.json'
          }
        });
    </script>
  @endpush
</x-app-layout>