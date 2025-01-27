<x-app-layout>
  @section('title', 'Memorias - ' . ($memory->id ? 'Actualizar' : 'Crear'))

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
      {{ __('Memorias') }}
    </h2>
  </x-slot>

  <div class="max-w-4xl mx-auto bg-slate-50 dark:bg-slate-800 rounded shadow-sm shadow-blue-600 my-12">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <div class="px-4 py-5 mx-auto text-center max-w-7xl sm:px-6 lg:py-2 lg:px-8">
        <h2 class="text-2xl font-extrabold tracking-tight text-slate-900 dark:text-slate-50 sm:text-3xl">
          <span class="block">
            @if (isset($memory->id))
              Actualizar - Memorias <br> Selects dinámicos con Constantes
            @else
              Crear - Memorias <br> Selects dinámicos con Constantes
            @endif
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
    {{-- Tema oscuro para Pikaday --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/pikaday-theme.css') }}"> --}}
    
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
    <!-- Actualizar la lista de velocidades según la tecnología seleccionada -->
    <script>
      document.getElementById('selectTechnology').addEventListener('change', updateList);
  
      function updateList() {
        const velocities = {!! json_encode(App\Models\Memory::VELOCITY_SELECT) !!};
        const selectedTechnology = this.value;
        const velocityOptions = velocities[selectedTechnology] || [];
        const velocitySelect = document.getElementById('selectVelocity');

        // Limpiar las opciones actuales
        velocitySelect.innerHTML = '<option value="">Seleccionar</option>';

        // Agregar las nuevas opciones
        velocityOptions.forEach(velocity => {
          const option = document.createElement('option');
          option.value = velocity;
          option.text = velocity;
          velocitySelect.appendChild(option);
        });

        // Mantener el valor seleccionado si aplica
        const oldVelocity = {!! json_encode(old('velocity', $memory->velocity)) !!};
        // Se mantiene el valor seleccionado si es válido y se encuentra en las opciones seleccionadas actualmente
        if (oldVelocity && velocityOptions.includes(oldVelocity)) {
          velocitySelect.value = oldVelocity;
        }
      }
  
      // Ejecutar al cargar la página para manejar valores previos
      document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('selectTechnology').dispatchEvent(new Event('change'));
      });
    </script>

    {{-- Pikaday - Fechas para las garantías --}}
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const fields = document.querySelectorAll('.warranties');

        fields.forEach(field => {
          new Pikaday({
            field: field,  // Aplica Pikaday a cada input
            format: 'YYYY-MM-DD',
            theme: 'dark-theme',
            firstDay: 1,
            i18n: {
              previousMonth: 'Mes anterior',
              nextMonth: 'Mes siguiente',
              months: [
                'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
              ],
              weekdays: [
                'Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'
              ],
              weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab']
            },
            toString(date, format) {
              // Formato personalizado para la salida (mantiene la fecha en local)
              const day = date.getDate().toString().padStart(2, '0');
              const month = (date.getMonth() + 1).toString().padStart(2, '0');
              const year = date.getFullYear();
              return `${year}-${month}-${day}`;
            },
            parse(dateString, format) {
              // Asegurarse de que Pikaday maneje la entrada sin desplazamiento
              const parts = dateString.split('-');
              const year = parseInt(parts[0], 10);
              const month = parseInt(parts[1], 10) - 1; // Meses en JavaScript son 0-indexados
              const day = parseInt(parts[2], 10);
              return new Date(year, month, day);
            },
            onSelect: function() {
              console.log(moment(this.getDate()).format('YYYY-MM-DD'));
              console.log(this.getDate());
            }
          });
        });
      });
    </script>

    <!-- Pikaday - Fecha de nacimiento -->
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const birthdateInput = document.getElementById('birthdate');
        const ageError = document.getElementById('ageError');

        // Obtener la fecha máxima permitida (18 años atrás)
        const today = new Date();
        const maxDate = new Date(
          today.getFullYear() - 18,
          today.getMonth(),
          today.getDate()
        );

        new Pikaday({
          field: birthdateInput,
          format: 'YYYY-MM-DD',
          theme: 'dark-theme',
          firstDay: 1,
          i18n: {
            previousMonth: 'Mes anterior',
            nextMonth: 'Mes siguiente',
            months: [
              'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
            ],
            weekdays: [
              'Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'
            ],
            weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab']
          },
          yearRange: [1960, maxDate.getFullYear()],
          maxDate: maxDate, // Limitar la fecha seleccionable a hace 18 años
          toString(date, format) {
            // Formato personalizado para la salida
            const day = date.getDate().toString().padStart(2, '0');
            const month = (date.getMonth() + 1).toString().padStart(2, '0');
            const year = date.getFullYear();
            return `${year}-${month}-${day}`;
          },
          parse(dateString, format) {
            // Asegurarse de que Pikaday maneje la entrada sin desplazamiento
            const parts = dateString.split('-');
            const year = parseInt(parts[0], 10);
            const month = parseInt(parts[1], 10) - 1; // Meses en JavaScript son 0-indexados
            const day = parseInt(parts[2], 10);
            return new Date(year, month, day);
          },
          onSelect: function(date) {
            console.log(moment(this.getDate()).format('YYYY-MM-DD'));
            console.log(this.getDate());
            validateAge(date);
          }
        });

        // Validar la edad al seleccionar una fecha
        function validateAge(selectedDate) {
          const age = today.getFullYear() - selectedDate.getFullYear();
          const monthDiff = today.getMonth() - selectedDate.getMonth();
          const dayDiff = today.getDate() - selectedDate.getDate();

          // Mostrar mensaje de error si la edad no es válida
          if (age < 18 || (age === 18 && (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)))) {
            ageError.classList.remove('hidden');
            birthdateInput.classList.add('border-red-500');
          } else {
            ageError.classList.add('hidden');
            birthdateInput.classList.remove('border-red-500');
          }
        }
      });
    </script>
  @endpush
</x-app-layout>