<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
      {{ __('Select Múltiple (Máx 2 elementos) con Alpine.js y Focus') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-slate-50 dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-slate-900 dark:text-slate-100">
          <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="px-4 py-5 mx-auto max-w-7xl sm:px-6 lg:py-2 lg:px-8">
              <h2 class="text-3xl text-center font-extrabold tracking-tight text-slate-900 dark:text-slate-50 sm:text-4xl">
                <span class="block">Select2</span>
              </h2>

              <div class="grid grid-cols-6 gap-x-10 gap-y-8">
                <div class="col-span-4 sm:col-span-2">
                  <div class="relative z-0 form-group">
                    <label for="users[]" class="block text-lg font-extrabold text-slate-800 dark:text-slate-50">
                      Select2 Simple
                    </label>
                    <select name="users" class="block w-full sm:text-xs placeholder-transparent border-b-2 border-slate-300 text-slate-800 bg-transparent dark:text-slate-300 dark:bg-slate-800 dark:focus:bg-slate-700 dark:focus:ring-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 select2-single">
                      <option selected value="">Seleccionar</option>
                      @foreach ($users as $user)
                        <option value="{{ $user->id }}">
                          {{ $user->name }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </div>
              
                <div class="col-span-6 sm:col-span-4">
                  <div class="relative z-0 form-group mt-1">
                    <label for="users[]" class="block text-lg font-extrabold text-slate-800 dark:text-slate-50">
                      Select2 Múltiple (Máx 2)
                    </label>
                    <select name="users[]" id="users[]" multiple="multiple" class="block w-full sm:text-xs placeholder-transparent border-b-2 border-slate-300 text-slate-800 bg-transparent dark:text-slate-300 dark:bg-slate-800 dark:focus:bg-slate-700 dark:focus:ring-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 select2-multiple" data-placeholder="Seleccionar">
                      @foreach ($users as $user)
                        <option value="{{ $user->id }}">
                          {{ $user->name }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div>
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
        $('.select2-multiple').select2({
          maximumSelectionLength: 3,
          language: "es"
        });
      });
    </script>
  @endpush
</x-app-layout>