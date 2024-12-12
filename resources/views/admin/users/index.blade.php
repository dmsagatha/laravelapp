<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
      {{ __('Usuarios') }}
    </h2>
  </x-slot>

  <div class="min-w-full mx-auto sm:px-6 lg:px-8 my-5">
    <div class="bg-slate-50 dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
      <div class="px-6 text-slate-900 dark:text-slate-100">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
          <div class="px-4 py-5 mx-auto text-center max-w-7xl sm:px-6 lg:py-2 lg:px-8">
            <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-slate-50 sm:text-3xl">
              <span class="block">
                <a href="#" target="_blank">Usuarios: Eliminacion y restauracion masiva</a>
              </span>
            </h2>
          </div>
        </div>

        <div class="flex float-left px-1 py-3 space-x-1 text-slate-800 dark:text-slate-50 flex-wrap">
          <button type="button" id="bulkDeleteButton" class="hidden items-center justify-center bg-red-600 border border-transparent rounded-md font-medium px-2 py-2 mr-2 mb-2 text-center text-xs text-slate-50 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring-0 focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 inline-flex">
              <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
            </svg>
            Seleccionados (<span id="select_count">0</span>)
          </button>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
          {{-- Listado --}}
          <div class="p-4 mt-14 shadow-md sm:rounded-lg">
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

    {{-- DataTables --}}
    <script>
      let table = new DataTable('#dtTheme', {
        responsive: true,
        lengthMenu: [[10, 15, 25, 50, 100, -1], [10, 15, 25, 50, 100, "Todos"]],
        pageLength: 15,
        processing: true,
        language: {
          url: 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/es-ES.json'
        }
      });
    </script>
    
    <script src="js/bulkDelete.js"></script>


    {{-- Evento para seleccionar todos los checkbox con Javascript --}}
    {{-- <script>
      const selectedAll = document.querySelector("#selectedAll");
      const itemSelected = document.querySelectorAll('#selectIds');

      // <input type="checkbox" id="selectedAll" onchange="selectAllChkboxes()" />
      /* function selectAllChkboxes() {
        const isChecked = selectedAll.checked;

        for (let i = 0; i < itemSelected.length; i++) {
          itemSelected[i].checked = isChecked;
        }
      } */

      // Evento de cambio de la casilla de verificación
      // Convertir la lista de nodos a una matriz con el método Array.from
      selectedAll.addEventListener('change', () => {
        Array.from(itemSelected).map((chkbx) => {
          chkbx.checked = selectedAll.checked;
        });
      });
    </script> --}}
  @endpush
</x-app-layout>