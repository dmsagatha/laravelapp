<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Listado de usuarios') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <h1 class="text-center text-xl text-gray-900 dark:text-white pb-2">Seleccionar Usuarios para Enviar Correo</h1>

          @if (session('success'))
            <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
              <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
              </svg>
              <span class="sr-only">Info</span>
              <div>
                <span class="font-medium">{{ session('success') }}</span> 
              </div>
            </div>
          @endif

          <form action="{{ route('user.send.emails') }}" method="POST" onsubmit="return confirmSubmission();">
            @csrf
            
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
              <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
                    <th scope="col" class="p-4">
                      <div class="flex items-center">
                        <input type="checkbox" onclick="toggleCheckboxes(this);" id="checkbox-all-search"
                          class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-all-search" class="sr-only">Seleccionar Todos</label>
                      </div>
                    </th>
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
                  @foreach ($users as $item)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                      <td class="w-4 p-4">
                        <div class="flex items-center">
                          <input type="checkbox" name="users[]" value="{{ $item->id }}" id="checkbox-table-search-1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                          <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                        </div>
                      </td>
                      <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $item->name }}
                      </th>
                      <td class="px-6 py-4">{{ $item->email }}</td>
                      <td class="flex items-center px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                        <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Eliminar</a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            <x-button-red type="submit">Enviar Correos</x-button-red>
          </form>
        </div>
      </div>
    </div>
  </div>

  @push('scripts')
    <script>
      // toggleCheckboxes(source): Esta función se llama cuando el checkbox "Seleccionar Todos" es clicado. Cambia el estado de todos los checkboxes individuales según el estado del checkbox "Seleccionar Todos".
      function toggleCheckboxes(source) {
        const checkboxes = document.querySelectorAll('input[name="users[]"]');
        checkboxes.forEach((checkbox) => {
          checkbox.checked = source.checked;
        });
      }

      // confirmSubmission(): Esta función se llama al enviar el formulario. Verifica si al menos un checkbox está seleccionado. Si no hay ninguno seleccionado, muestra un mensaje de alerta y evita el envío del formulario. Si hay al menos uno seleccionado, muestra un cuadro de confirmación para que el usuario confirme si realmente desea enviar el correo.
      function confirmSubmission() {
        const checkboxes = document.querySelectorAll('input[name="users[]"]:checked');
        if (checkboxes.length === 0) {
          alert('Por favor, selecciona al menos un usuario para enviar el correo.');
          return false; // Evita el envío del formulario
        }
        return confirm('¿Estás seguro de que deseas enviar el correo a los usuarios seleccionados?');
      }
    </script>
  @endpush
</x-app-layout>