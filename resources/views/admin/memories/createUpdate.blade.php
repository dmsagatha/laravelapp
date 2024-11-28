<x-app-layout>
  @section('title', 'Memorias - ' . ($memory->id ? 'Actualizar' : 'Crear'))

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
              {{ isset($memory->id) ? 'Actualizar' : 'Crear' }} Memorias - Selects dinámicos con Constantes
            </a>
          </span>
        </h2>

        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
          <div class="dot-flashing">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>
      </div>
    </div>

    <div class="p-10">
      <form x-data="{ loading: false }" @submit="loading = true" method="POST" action="{{ isset($memory->id) ? route('memories.update', $memory) : route('memories.store') }}">
        @csrf
        @if (isset($memory->id))
          @method('PUT')
        @endif

        @include('admin.memories._fields')

        <div class="py-3 bg-slate-50 dark:bg-slate-800 text-center space-x-2">
          <button type="submit" class="w-36 inline-flex items-center justify-center bg-green-600 border border-transparent rounded-md font-medium p-2 mr-2 mb-2 text-center text-sm text-white hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring-0 focus:ring-green-200 active:bg-green-600 disabled:opacity-25 transition">
            {{ isset($memory->id) ? 'Actualizar' : 'Crear' }}
          </button>
          <button class="w-36 inline-flex items-center justify-center bg-red-600 border border-transparent rounded-md font-medium p-2 mr-2 mb-2 text-center text-sm text-white hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring-0 focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition">
            <a href="{{ route('memories.index') }}">Cancelar</a>
          </button>
        </div>
      </form>
    </div>
  </div>

  @push('styles')
    <style>
      .dot-flashing {
          display: flex;
          gap: 4px;
      }
      .dot-flashing span {
          width: 8px;
          height: 8px;
          border-radius: 50%;
          background-color: #4A5568; /* Color gris (personalizable) */
          animation: dotFlashing 1.2s infinite ease-in-out both;
      }
      .dot-flashing span:nth-child(2) {
          animation-delay: 0.2s;
      }
      .dot-flashing span:nth-child(3) {
          animation-delay: 0.4s;
      }
  
      @keyframes dotFlashing {
          0%, 80%, 100% {
              opacity: 0;
          }
          40% {
              opacity: 1;
          }
      }
    </style>
  @endpush

  @push('scripts')
    <script>
      document.getElementById('selectTechnology').onchange = updateList;

      function updateList() {
        velocities = {!!json_encode(App\Models\Memory::VELOCITY_SELECT) !!} [this.value] ? {!!json_encode(App\Models\Memory::VELOCITY_SELECT) !!} [this.value] : [];
        var velocitySelect = document.getElementById('selectVelocity');

        velocitySelect.options.length = 1;

        for (var i = 0; i < velocities.length; i++) {
          var option = document.createElement('option');
          option.value = velocities[i];
          option.text = velocities[i];
          velocitySelect.appendChild(option);
        }
      }
    </script>
  @endpush
</x-app-layout>