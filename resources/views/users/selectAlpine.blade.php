<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
      <a href="https://codewithhugo.com/alpinejs-jquery-plugin-integration-select2/" target="_blank">
        {{ __('Alpine.js + jQuery/JavaScript Plugin Integration: a Select2 example') }}
      </a>
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-slate-50 dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-slate-900 dark:text-slate-100">
          <div x-data="{ selectedElement: '' }" x-init="select2Alpine">
            <select 
              x-ref="select"
              data-placeholder="Seleccionar Usuario" 
              class="block w-full sm:text-xs placeholder-transparent border-b-2 border-slate-300 text-slate-800 bg-transparent dark:text-slate-300 dark:bg-slate-800 dark:focus:bg-slate-700 dark:focus:ring-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 select2-single">
              <option selected value="">Seleccionar</option>
              @foreach ($users as $user)
                <option value="{{ $user->id }}">
                  {{ $user->name }}
                </option>
              @endforeach
            </select>
            <p class="text-slate-100">Valor seleccionado (Enlazado en Alpine.js): <code x-text="selectedElement"></code></p>

            <div class="py-5">
              <x-danger-button @click="selectedElement = ''">
                Reiniciar selectedElement
              </x-danger-button>
            </div>
          </div>

          <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <h1 class="py-5 text-center text-xl text-slate-900 dark:text-slate-50 pb-2">Listado de Usuarios</h1>

            <table class="w-full text-sm text-left rtl:text-right text-slate-500 dark:text-slate-400">
              <thead class="text-xs text-slate-700 uppercase bg-slate-50 dark:bg-slate-700 dark:text-slate-400">
                <tr>
                  <th>N°</th>
                  <th scope="col" class="px-6 py-3">
                    Nombre
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Correo Electrónico
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Acciones
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $key => $item)
                  <tr
                    class="bg-slate-50 border-b dark:bg-slate-800 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600">
                    <td>{{ $key + 1 }}</td>
                    <th scope="row"
                      class="px-6 py-4 font-medium text-slate-900 slate-50space-nowrap dark:text-slate-50">
                      {{ $item->name }}
                    </th>
                    <td class="px-6 py-4">{{ $item->email }}</td>
                    <td class="flex items-center px-6 py-4">
                      <a href="#"
                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                      <a href="#"
                        class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Eliminar</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  @push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  @endpush

  @push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        
    <script>
      $(document).ready(function() {
        $('.select2-single').select2({
          language: "es"
        });
      });

      function select2Alpine() {
        this.select2 = $(this.$refs.select).select2();
        this.select2.on("select2:select", (event) => {
          this.selectedElement = event.target.value;
        });
        this.$watch("selectedElement", (value) => {
          this.select2.val(value).trigger("change");
        });
      }
    </script>
  @endpush
</x-app-layout>