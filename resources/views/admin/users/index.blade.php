<x-app-layout>
  @section('title', 'Usuarios')

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
      {{ __('Eliminación masiva') }}
    </h2>
  </x-slot>

  <div class="flow-root w-full shadow my-5 p-2 rounded sm:px-1 sm:py-2 bg-slate-50 dark:bg-slate-800">
    <h1 class="flex justify-center font-sans font-bold break-normal py-3 text-xl md:text-2xl text-slate-600 dark:text-slate-300">
      Eliminación masiva de Usuarios
    </h1>

    {{-- Filtros y Eliminación masiva --}}
    <div class="flex float-left px-1 py-3 space-x-1 text-slate-800 dark:text-slate-50 flex-wrap">
    </div>

    {{-- Enviar correos, Exportar e Importar --}}
    <div class="flex float-right px-0 py-3 space-x-0 text-slate-800">
    </div>

    {{-- Listado --}}
    <div class="p-4 shadow-md sm:rounded-lg">
      @if ($users->count())
        @include('admin.users._table')
      @else
        <div class="flex justify-center items-center py-4 text-slate-700 dark:text-slate-200">
          No hay registros creados
        </div>
      @endif
    </div>
  </div>

  @push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
  @endpush

  @push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
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
      let table = new DataTable('#dtTailwindcss', {
        responsive: true,
        lengthMenu: [[10, 15, 25, 50, 100, -1], [10, 15, 25, 50, 100, "Todos"]],
        pageLength: 15,
        processing: true,
        language: {
          url: 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/es-ES.json'
        }
      });
    </script>
  @endpush
</x-app-layout>