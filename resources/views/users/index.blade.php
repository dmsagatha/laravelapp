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
          <h1>Seleccionar Usuarios para Enviar Correo</h1>

          @if(session('success'))
            <div>{{ session('success') }}</div>
          @endif
          
          <form action="{{ route('enviar.correos') }}" method="POST">
            @csrf

            <table>
              <thead>
                  <tr>
                      <th>Seleccionar</th>
                      <th>Nombre</th>
                      <th>Email</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($usuarios as $usuario)
                      <tr>
                          <td>
                            <input type="checkbox" name="usuarios[]" value="{{ $usuario->id }}">
                          </td>
                          <td>{{ $usuario->name }}</td>
                          <td>{{ $usuario->email }}</td>
                      </tr>
                  @endforeach
              </tbody>
            </table>
            
            <x-button-red type="submit">Enviar Correos</x-button-red>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>