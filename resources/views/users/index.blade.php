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

          <form action="{{ route('enviar.correos') }}" method="POST">
            @csrf
            
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
              <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
                    <th scope="col" class="p-4">
                      <div class="flex items-center">
                        <input id="checkbox-all-search" type="checkbox"
                          class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-all-search" class="sr-only">Seleccionar</label>
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
                  @foreach ($usuarios as $usuario)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                      <td class="w-4 p-4">
                        <div class="flex items-center">
                          <input type="checkbox" name="usuarios[]" value="{{ $usuario->id }}" id="checkbox-table-search-1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                          <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                          {{-- <input type="checkbox" name="usuarios[]" value="{{ $usuario->id }}"> --}}
                        </div>
                      </td>
                      <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $usuario->name }}
                      </th>
                      <td class="px-6 py-4">{{ $usuario->email }}</td>
                      <td class="flex items-center px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                        <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Eliminar</a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>


            {{-- <table>
              <thead>
                <tr>
                  <th>Seleccionar</th>
                  <th>Nombre</th>
                  <th>Email</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($usuarios as $usuario)
                  <tr>
                    <td>
                      <input type="checkbox" name="usuarios[]" value="{{ $usuario->id }}">
                    </td>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table> --}}

            <x-button-red type="submit">Enviar Correos</x-button-red>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
