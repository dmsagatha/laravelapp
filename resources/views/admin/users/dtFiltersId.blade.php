<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
      {{ __('DT-Filtros') }}
    </h2>
  </x-slot>

  <div class="min-w-full mx-auto sm:px-6 lg:px-8 my-12">
    <div class="bg-slate-50 dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
      <div class="px-6 text-slate-900 dark:text-slate-100">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
          <div class="px-4 py-5 mx-auto text-center max-w-7xl sm:px-6 lg:py-2 lg:px-8">
            <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-slate-50 sm:text-4xl">
              <span class="block">
                <a href="https://www.youtube.com/watch?v=e-HA2YQUoi0" target="_blank">DataTables: Filtros por el Elemento ID</a>
              </span>
            </h2>
          </div>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg dark">
          <x-selectFilter id="country_filter" label="Países" class="w-36">
            @foreach ($countries as $country)
              <option value="{{ $country }}">{{ $country }}</option>
            @endforeach
          </x-selectFilter>
          
          <x-selectFilter id="jobTitle_filter" label="Profesiones" class="w-36">
            @foreach ($professions as $jobTitle)
              <option value="{{ $jobTitle }}">{{ $jobTitle }}</option>
            @endforeach
          </x-selectFilter>

          <x-btn-outline type="reset" onclick="location.reload()">
            Refrescar paǵina
          </x-btn-outline>

          <table id="dtFiltersId" class="display compact" style="width:100%">
            <thead>
              <tr>
                <th rowspan="2" width="1%">N°</th>
                <th rowspan="2">Nombre</th>
                <th rowspan="2">Correo Electrónico</th>
                <th rowspan="2">Género</th>
                <th colspan="3">Datos Personales</th>
                <th rowspan="2">Acciones</th>
              </tr>
              <tr>
                <th>Profesión</th>
                <th>País</th>
                <th>Teléfono</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $key => $item)
                <tr>
                  <td style="text-align: center;">{{ $key + 1 }}</td>
                  <th>{{ $item->name }}</th>
                  <td>{{ $item->email }}</td>
                  <td>{{ App\Models\User::GENDER_SELECT[$item->gender] ?? '' }}</td>
                  <th>{{ $item->jobTitle }}</th>
                  <th>{{ $item->country }}</th>
                  <td>{{ $item->phone_number }}</td>
                  <td>
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                    <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Eliminar</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>N°</th>
                <th>Nombre Completo</th>
                <th>Correo Electrónico</th>
                <th>Género</th>
                <th>Profesión</th>
                <th>País</th>
                <th>Teléfono</th>
                <th>Acciones</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>

  @push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.css">
  @endpush

  @push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.dataTables.js"></script>

    {{-- Filtros por el Elemto ID - https://jsfiddle.net/Ratan_Paul/5Lj6peof/1/ --}}
    <script>
      let table = new DataTable('#dtFiltersId', {
        responsive: true,
        lengthMenu: [[5, 10, 15, 25, 50, 100, -1], [5, 10, 15, 25, 50, 100, "Todos"]],
        pageLength: 10,
        processing: true,
        language: {
          url: 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/es-ES.json'
        }
      });

      $('#country_filter').change(function () {
        table.columns(5).search(this.value).draw();
      });
      $('#jobTitle_filter').change(function () {
        table.columns(4).search(this.value).draw();
      });
    </script>
  @endpush
</x-app-layout>