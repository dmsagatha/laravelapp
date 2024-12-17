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

    {{-- Eliminación masiva --}}
    <div class="flex float-left px-1 py-3 space-x-1 text-slate-800 dark:text-slate-50 flex-wrap">
      @if ($view == 'index')
        <form id="bulkDeleteForm" action="{{ route('users.massDestroy') }}" method="POST">
          @csrf
          @method('DELETE')
                    
          <input type="hidden" name="ids" id="bulkDeleteIds">

          <button
            type="button"
            id="bulkDeleteButton"
            class="hidden items-center justify-center bg-red-600 border border-transparent rounded-md font-medium px-2 py-2 mr-2 mb-2 text-center text-xs text-slate-50 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring-0 focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 inline-flex">
              <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
            </svg>
            Eliminar seleccionados (<span id="select_count">0</span>)
          </button>
        </form>
      @endif
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

  <!-- Modal para confirmar o cancelar la eliminación masiva -->
  <div id="deleteModal" class="hidden fixed inset-0 z-10 justify-center items-center h-full w-full bg-black/50" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
    <!-- Modal content -->
    <div class="bg-slate-50 dark:bg-slate-700 rounded-lg shadow-lg p-4 max-w-lg w-full">
      <!-- Modal header -->
      <div class="py-4">
        <svg class="mx-auto mb-4 text-slate-400 w-12 h-12 dark:text-slate-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        <h4 class="text-xl font-bold text-center">¿Confirma eliminar los registros seleccionados?</h4>
      </div>
      <!-- Modal body -->
      <div class="flex justify-end space-x-2 my-4">
        <button id="confirmDeleteButton" type="button" class="bg-red-600 border border-transparent rounded-md font-medium px-2 py-2 mr-2 text-center text-slate-50 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring-0 focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition-transform transform active:scale-95">
          Si, eliminar!
        </button>
        <button id="cancelButton" type="button" class="bg-blue-600 border border-transparent rounded-md font-medium px-2 py-2 mr-2 text-center text-slate-50 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring-0 focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition-transform transform active:scale-95">
          No, cancelar!
        </button>
      </div>
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
        lengthMenu: [[5, 10, 15, 25, 50, 100, -1], [5, 10, 15, 25, 50, 100, "Todos"]],
        pageLength: 5,
        processing: true,
        language: {
          url: 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/es-ES.json'
        }
      });
    </script>

    <script src="{{ asset('js/bulkDelete.js') }}"></script>
    {{-- <script src="{{ asset('js/eliminacionMasiva.js') }}"></script> --}}
  @endpush
</x-app-layout>