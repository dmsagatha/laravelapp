<x-app-layout>
  @section('title', 'Usuarios')

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
      {{ __('Eliminación masiva') }}
    </h2>
    <h1 class="pb-1">{{ trans("users.title.{$view}") }}</h1>
  </x-slot>

  <div class="flow-root w-full shadow my-5 p-2 rounded sm:px-1 sm:py-2 bg-slate-50 dark:bg-slate-800">
    <h1 class="flex justify-center font-sans font-bold break-normal py-3 text-xl md:text-2xl text-slate-600 dark:text-slate-300">
      Eliminación masiva de Usuarios
    </h1>

    {{-- Mensaje de éxito --}}
    {{-- @if (session()->has('status'))
    <div class="flex items-center bg-green-500 text-white text-sm font-bold px-4 py-3 mb-3 rounded" role="alert">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
        class="w-5 h-5 mr-2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
      </svg>
      <p>{{ session('status') }}</p>
    </div>
    @endif --}}

    <!-- Contenedor de notificaciones -->
    {{-- <div id="notificationContainer" class="fixed top-32 right-4 space-y-4 z-50"></div> --}}

    @if(session('message'))
      <x-alert :type="session('type')" :message="session('message')" position="top-right" />
    @endif

    {{-- Eliminación y restauración masiva --}}
<div class="flex float-left px-1 py-3 space-x-1 text-slate-800 dark:text-slate-50 flex-wrap">
  @if ($view == 'index')
    <!-- Botones de acción -->
    <button
      type="button" 
      id="deleteButton" 
      data-action="{{ route('users.massDestroy') }}" 
      data-method="DELETE" 
      data-title="Confirmar Eliminación" 
      data-message="¿Está seguro de que desea eliminar los registros seleccionados?" 
      class="hidden bg-red-600 text-white px-4 py-2 rounded hover:bg-red-500">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
      </svg>
      <span id="deleteButtonText"></span>
      Eliminar seleccionados (0)
    </button>
  @else
    <!-- Botones de acción -->
    <button
      type="button"
      id="restoreButton"
      data-action="{{ route('users.massRestore') }}"
      data-method="POST"
      data-title="Confirmar restauración" 
      data-message="¿Está seguro de que desea restaurar los registros seleccionados?"
      class="hidden restoreButton bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
      Restaurar seleccionados (0)
    </button>
    <button
      type="button"
      id="forceDeleteButton"
      data-action="{{ route('users.massForceDestroy') }}"
      data-method="DELETE"
      data-title="Eliminar Definitivamente"
      data-message="¿Está seguro de que desea eliminar definitivamente los registros seleccionados?"
      class="hidden bg-gray-800 text-white">
      Eliminar definitivamente (0)
    </button>
  @endif
</div>

    {{-- Papelera y Regresar al listado --}}
    <div class="flex float-right px-0 py-3 space-x-0 text-slate-800">
      @if ($view == 'index')
        <a href="{{ route('users.trashed') }}" class="relative inline-flex items-center justify-center text-blue-800 hover:text-slate-50 border border-blue-500 hover:bg-blue-700 focus:ring-1 focus:outline-none focus:ring-blue-300 font-medium rounded-lg p-2 mr-2 mb-2 text-center text-sm dark:border-slate-500 dark:text-slate-400 dark:hover:text-slate-50 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
          </svg>
          Ver Papelera
        </a>
      @else
        <a href="{{ route('users.index') }}" class="relative inline-flex items-center justify-center text-blue-800 hover:text-slate-50 border border-blue-500 hover:bg-blue-700 focus:ring-1 focus:outline-none focus:ring-blue-300 font-medium rounded-lg p-2 mr-2 mb-2 text-center text-sm dark:border-slate-500 dark:text-slate-400 dark:hover:text-slate-50 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.242 5.992h12m-12 6.003H20.24m-12 5.999h12M4.117 7.495v-3.75H2.99m1.125 3.75H2.99m1.125 0H5.24m-1.92 2.577a1.125 1.125 0 1 1 1.591 1.59l-1.83 1.83h2.16M2.99 15.745h1.125a1.125 1.125 0 0 1 0 2.25H3.74m0-.002h.375a1.125 1.125 0 0 1 0 2.25H2.99" />
          </svg>
          Regresar al listado
        </a>
      @endif
    </div>

    {{-- Listado --}}
    <div class="p-4 shadow-md sm:rounded-lg">
      @if ($users->count())
        @include('admin.users._table')
      @else
        <div class="flex justify-center items-center py-4 text-slate-700 dark:text-slate-200">
          No hay registros creados
        </div>
      @endif
    </div>
  </div>

  <!-- Modal para confirmar o cancelar la eliminación masiva -->
  <div id="actionModal"
    class="hidden fixed inset-0 z-10 justify-center items-center h-full w-full bg-black/50 transition-opacity duration-300 ease-in-out"
    role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
    <!-- Modal content -->
    <div
      class="bg-slate-50 dark:bg-slate-700 rounded-lg shadow-lg p-4 max-w-lg w-full transform scale-95 transition-all duration-300 ease-in-out">
      <!-- Modal header -->
      <div class="py-4">
        <svg class="mx-auto mb-4 text-slate-400 w-12 h-12 dark:text-slate-200" aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        <h2 id="modalTitle" class="text-xl font-semibold text-slate-800 dark:text-slate-50 text-center"></h2>
        <p id="modalMessage" class="text-slate-600 dark:text-slate-300 mb-6"></p>
      </div>
      <!-- Modal body -->
      <div class="flex justify-end space-x-2 my-4">
        <form id="modalForm" method="POST">
          @csrf
          @method('POST')

          <button id="confirmButton" type="submit"
            class="bg-red-600 border border-transparent rounded-md font-medium px-2 py-2 mr-2 text-center text-slate-50 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring-0 focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition">
            Confirmar
          </button>
          <button id="modalCancelButton" type="button"
            class="bg-blue-600 border border-transparent rounded-md font-medium px-2 py-2 mr-2 text-center text-slate-50 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring-0 focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">
            Cancelar
          </button>
        </form>
      </div>
    </div>
  </div>

  @include('partials.dataTables')
</x-app-layout>