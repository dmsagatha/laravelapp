<x-app-layout>
  {{-- @section('title', 'Memorias - ' . ($memory->id ? 'Actualizar' : 'Crear')) --}}

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
      {{ __('Memorias') }}
    </h2>
  </x-slot>

  <div class="max-w-4xl mx-auto bg-slate-50 dark:bg-slate-800 rounded shadow-md shadow-blue-600">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <div class="px-4 py-5 mx-auto text-center max-w-7xl sm:px-6 lg:py-2 lg:px-8">
        <h2 class="text-2xl font-extrabold tracking-tight text-slate-900 dark:text-slate-50 sm:text-3xl">
          <span class="block">
            <a href="#" target="_blank">
              Crear Memorias - Selects dinámicos con Constantes
            </a>
          </span>
        </h2>
      </div>
    </div>

    <div class="p-10">
      <form action="{{ route('memories.store') }}" method="POST">
        @csrf

        @include('admin.memories._fields')

        <div class="py-5 bg-slate-50 dark:bg-slate-800 text-center space-y-2">
          <button type="submit" class="w-36 inline-flex items-center justify-center bg-green-600 border border-transparent rounded-md font-medium px-2 py-2 mr-2 mb-2 text-center text-sm text-white hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring-0 focus:ring-green-200 active:bg-green-600 disabled:opacity-25 transition">
            {{ isset($memory->id) ? 'Actualizar' : 'Crear' }}
          </button>
          <button class="w-36 inline-flex items-center justify-center bg-red-600 border border-transparent rounded-md font-medium px-2 py-2 mr-2 mb-2 text-center text-sm text-white hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring-0 focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition">
            <a href="{{ route('memories.index') }}">Cancelar</a>
          </button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>