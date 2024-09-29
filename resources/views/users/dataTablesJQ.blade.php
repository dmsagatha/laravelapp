<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
      {{ __('DataTables JQuery') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-slate-50 dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-slate-900 dark:text-slate-100">
          <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="px-4 py-5 mx-auto text-center max-w-7xl sm:px-6 lg:py-2 lg:px-8">
              <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-slate-50 sm:text-4xl">
                <span class="block">
                  <a href="#" target="_blank">DataTables JQuery con Tailwind CSS</a>
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
            <table id="dtTheme" class="row-border" style="width:100%">
              <thead>
                <tr>
                  <th>N°</th>
                  <th>Nombre</th>
                  <th>Correo Electrónico</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $key => $item)
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <th>{{ $item->name }}</th>
                    <td>{{ $item->email }}</td>
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
    <link rel="stylesheet" href="">
  @endpush

  @push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>

    <script>
      new DataTable('#dtTheme');
    </script>
  @endpush
</x-app-layout>