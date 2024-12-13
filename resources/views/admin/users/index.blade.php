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
        <a href="javascript:void(0)" 
          id="bulkDeleteButton"
          class="relative inline-flex items-center justify-center p-2 mr-2 mb-2 text-red-600 border border-blue-500 hover:bg-red-500 hover:text-slate-50 active:bg-red-600 font-medium rounded-lg outline-none focus:outline-none ease-linear transition-all duration-150">
          🗑️ Eliminar seleccionados (<span id="select_count">0</span>)
        </a>
        
        <form id="bulkDeleteForm" action="{{ route('users.massDestroy') }}" method="POST">
          @csrf
          @method('DELETE')

          {{-- <button type="submit" class="bulkDeleteButton items-center justify-center bg-red-600 border border-transparent rounded-md font-medium px-2 py-2 mr-2 mb-2 text-center text-xs text-slate-50 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring-0 focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition">
            Eliminar Seleccionados
          </button> --}}

          <div>
            <input type="checkbox" id="selectAll" onclick="toggleAllCheckboxes(this)">
            <label for="selectAll">Seleccionar Todos</label>
          </div>

          @include('admin.users._table')
        </form>
      @endif
    </div>

    {{-- Enviar correos, Exportar e Importar --}}
    <div class="flex float-right px-0 py-3 space-x-0 text-slate-800">
    </div>

    {{-- Listado --}}
    {{-- <div class="p-4 shadow-md sm:rounded-lg">
      @if ($users->count())
        @include('admin.users._table')
      @else
        <div class="flex justify-center items-center py-4 text-slate-700 dark:text-slate-200">
          No hay registros creados
        </div>
      @endif
    </div> --}}
  </div>

  @push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
  @endpush

  @push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.dataTables.js"></script>

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

    {{-- <script src="{{ asset('js/bulkDelete.js') }}"></script> --}}
    <script src="{{ asset('js/eliminacionMasiva.js') }}"></script>
  @endpush
</x-app-layout>