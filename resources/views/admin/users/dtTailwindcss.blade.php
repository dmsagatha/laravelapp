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
            <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-slate-50 sm:text-4xl">
              <span class="block">
                <a href="https://datatables.net/extensions/responsive/examples/initialisation/default.html" target="_blank">DataTables.Net con Tailwind CSS</a>
              </span>
            </h2>
            <span class="block mt-4">Este ejemplo usa
              <a href="https://tailwindcss.com/" target="_new" class="text-indigo-600" alt="Tailwind CSS">
                DataTables.Net y Tailwind CSS (Temas)
              </a>
            </span>
          </div>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg dark">
          {{-- <table id="dtTheme" class="display compact nowrap row-border stripe" style="width:100%"> --}}
          <table id="dtTailwindcss" class="display" style="width:100%">
            <thead>
              <tr>
                <th rowspan="2" width="1%">N°</th>
                <th rowspan="2">Nombre</th>
                <th rowspan="2">Correo Electrónico</th>
                <th colspan="2">Datos Personales</th>
                <th rowspan="2">Acciones</th>
              </tr>
              <tr>
                <th>País</th>
                <th>Profesión</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $key => $item)
                <tr>
                  <td style="text-align: center;">{{ $key + 1 }}</td>
                  <th>{{ $item->name }}</th>
                  <td>{{ $item->email }}</td>
                  <th>{{ $item->country }}</th>
                  <td>{{ $item->jobTitle }}</td>
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
                <th>Profesión</th>
                <th>Acciones</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>

  @include('partials.dataTables')
</x-app-layout>