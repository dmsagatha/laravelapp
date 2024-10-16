<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
      {{ __('DT-Filtros') }}
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
                  <a href="https://www.youtube.com/watch?v=e-HA2YQUoi0" target="_blank">DataTables y Filtros</a>
                </span>
              </h2>
            </div>
          </div>

          <div class="relative overflow-x-auto shadow-md sm:rounded-lg dark">
            <x-btn-outline type="reset" onclick="location.reload()"
            iconFa="fa-filter">
              Refrescar paǵina
            </x-btn-outline>

            <table id="dtFilters" class="display compact" style="width:100%">
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
                  <th>
                    <input type="text" class="filter-input" placeholder="Buscar por Nombre" data-column="1" />
                  </th>
                  <th>
                    <input type="text" class="filter-input" placeholder="Buscar por Correo" data-column="2" />
                  </th>
                  <th>Género</th>
                  <th>Profesión</th>
                  <th>País</th>
                  <th>Teléfono</th>
                  <th>Acciones</th>
                </tr>
                <tr>
                  <th>N°</th>
                  <th>
                    <select data-column="1" class="filter-select">
                      <option value="">Seleccionar Nombre</option>
                      @foreach ($full_names as $name)
                        <option value="{{ $name }}">{{ $name }}</option>
                      @endforeach
                    </select>
                  </th>
                  <th>Correo electrónico</th>
                  <th>Género</th>
                  <th>
                    <select data-column="4" class="filter-select">
                      <option value="">Seleccionar Profesión</option>
                      @foreach ($professions as $jobTitle)
                        <option value="{{ $jobTitle }}">{{ $jobTitle }}</option>
                      @endforeach
                    </select>
                  </th>
                  <th>
                    <select data-column="5"class="filter-select">
                      <option value="">Seleccionar País</option>
                      @foreach ($countries as $country)
                        <option value="{{ $country }}">{{ $country }}</option>
                      @endforeach
                    </select>
                  </th>
                  <th>Teléfono</th>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.css">
  @endpush

  @push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.dataTables.js"></script>

    <script>
      let table = new DataTable('#dtFilters', {
        responsive: true,
        lengthMenu: [[5, 10, 15, 25, 50, 100, -1], [5, 10, 15, 25, 50, 100, "Todos"]],
        pageLength: 10,
        processing: true,
        language: {
          url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-MX.json'
        }
      });

      $('.filter-input').keyup(function() {
        table.column($(this).data('column'))
        .search($(this).val())
        .draw();
      });

      $('.filter-select').change(function() {
        table.column($(this).data('column'))
        .search($(this).val())
        .draw();
      });
    </script>
  @endpush
</x-app-layout>