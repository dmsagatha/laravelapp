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
            <div class="px-4 py-5 mx-auto text-center max-w-7xl sm:px-6 lg:py-2 lg:px-8">
              <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-slate-50 sm:text-4xl">
                <span class="block">Alpine.js MultiSelect (Máx 2 elementos)</span>
              </h2>
              <span class="block mt-4">Este ejemplo usa
                <a href="https://tailwindcss.com/" target="_new" class="text-indigo-600" alt="Tailwind CSS">
                  Tailwind CSS
                </a>,
                <a href="https://heroicons.com/" target="_new" class="text-indigo-600" alt="Heroicons">
                  Heroicons
                </a>
                y
                <a href="https://alpinejs.dev/plugins/focus" target="_new" class="text-indigo-600"
                  alt="Alpine's Focus plugin">
                  Alpine's Focus plugin
                </a>
              </span>
              <div class="flex justify-center mt-8">
                <!-- Define component with preselected options -->
                <div class="w-full" x-data="alpineMuliSelect({ selected: ['te_11', 'te_12'], elementId: 'multSelect' })">
                  <!-- Select Options -->
                  <select class="hidden" id="multSelect">
                    @foreach ($users as $user)
                      <option value="{{ $user->id }}" data-search="{{ $user->name }}">
                        {{ $user->name }}
                      </option>
                    @endforeach
                  </select>
  
                  <!-- Mostrar mensaje de error -->
                  <div x-show="errorMessage" class="text-red-500 dark:text-slate-100 mt-2">
                    <p x-text="errorMessage"></p>
                  </div>

                  <div class="w-full flex flex-col items-center h-64 mx-auto" @keyup.alt="toggle">
                    <!-- Selected Users -->
                    <input name="users[]" type="hidden" x-bind:value="selectedValues()">

                    <div class="inline-block relative w-full">
                      <div class="flex flex-col items-center relative">
                        <!-- Selected elements container -->
                        <div class="w-full">
                          <div class="my-2 p-1 flex border border-slate-200 dark:border-slate-400 bg-slate-50 dark:bg-slate-800 rounded-md">
                            <div class="flex flex-auto flex-wrap" x-on:click="open">
                              <!-- Iterating over selected elements -->
                              <template x-for="(option,index) in selectedElms" :key="option.value">
                                <div x-show="index < 2" class="flex justify-center items-center m-1 font-medium py-1 px-2 rounded-full text-indigo-700 bg-indigo-100 dark:text-indigo-50 dark:bg-indigo-800 border border-indigo-300">
                                  <div class="text-xs font-normal leading-none max-w-full flex-initial"
                                    x-model="selectedElms[option]" x-text="option.text"></div>
                                  <div class="flex flex-auto flex-row-reverse">
                                    <div x-on:click.stop="remove(index,option)">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                      </svg>
                                    </div>
                                  </div>
                                </div>
                              </template>
                              <!-- More than two items selected -->
                              <div x-show="selectedElms.length > 2" class="flex justify-center items-center m-1 font-medium py-1 px-2 rounded-full text-indigo-700 bg-indigo-100 dark:text-indigo-50 dark:bg-indigo-800 border border-indigo-300 ">
                                <div class="text-xs font-normal h-6 flex justify-center items-center leading-none max-w-full flex-initial">
                                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium text-pink-800 bg-indigo-200 mr-2">
                                    <span x-text="selectedElms.length -2"></span>
                                  </span>
                                  Más seleccionados
                                </div>
                              </div>
                              <!-- None items selected -->
                              <div x-show="selectedElms.length == 0" class="flex-1">
                                <input placeholder="Seleccionar usuarios" class="w-full bg-transparent text-slate-800 dark:text-slate-50 p-1 px-2 appearance-none outline-none h-full" x-bind:value="selectedElements()">
                              </div>
                            </div>
                            <!-- Drop down toogle with icons-->
                            <div class="w-8 text-slate-300 py-1 pl-2 pr-1 border-l flex items-center border-slate-200">
                              <button type="button" x-show="!isOpen()" x-on:click="open()"
                                class="cursor-pointer w-6 h-6 text-slate-600 dark:text-slate-50 outline-none focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                              </button>
                              <button type="button" x-show="isOpen()" x-on:click="close()"
                                class="cursor-pointer w-6 h-6 text-slate-600 dark:text-slate-50 outline-none focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                  viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                                </svg>
                              </button>
                            </div>
                          </div>
                        </div>
                        <!-- Dropdown container -->
                        <div class="w-full">
                          <div x-show.transition.origin.top="isOpen()" x-trap="isOpen()" class="absolute shadow-lg top-100 bg-slate-50 z-40 w-full lef-0 rounded max-h-80" x-on:click.away="close">
                            <div class="flex flex-col w-full">
                              <div class="px-2 py-4 border-b-2">
                                <!-- Search input-->
                                <div class="mt-1 relative rounded-md shadow-sm">
                                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                  </div>
                                  <input type="text" name="search" autocomplete="off" id="search" x-model.debounce.750ms="search" class="w-full focus:ring-indigo-500 focus:border-indigo-500 block pl-10 sm:text-sm border border-indigo-300 rounded-md h-10" placeholder="" @keyup.escape="clear" @keyup.delete="deselect">
                                  <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
                                    <kbd class="inline-flex items-center border border-slate-200 rounded px-2 text-sm font-sans font-medium text-slate-400 mr-2" x-on:click="clear">
                                      Cancelar
                                    </kbd>
                                    <kbd class="inline-flex items-center border border-slate-200 rounded px-2 text-sm font-sans font-medium text-slate-400" x-on:click="deselect">
                                      Eliminar
                                    </kbd>
                                  </div>
                                </div>
                              </div>
                              <!-- Options container -->
                              <ul class="z-10 mt-0 w-full bg-slate-50 shadow-lg max-h-80 rounded-md py-0 text-base ring-1 ring-black ring-opacity-5 focus:outline-none  overflow-y-auto sm:text-sm" tabindex="-1" role="listbox" @keyup.delete="deselect">
                                <template x-for="(option,index) in options" :key="option.text">
                                  <li class="text-slate-900 cursor-default select-none relative py-2 pl-3 pr-3" role="option">
                                    <div class="cursor-pointer w-full border-slate-100 rounded-t border-b hover:bg-slate-100"
                                      x-bind:class="option.selected ? 'bg-indigo-100' : ''"
                                      @click="select(index,$event)">
                                      <div x-bind:class="option.selected ? 'border-indigo-600' : ''"
                                        class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative">
                                        <div class="w-full items-center flex">
                                          <div class="mx-2 leading-6" x-model="option" x-text="option.text"></div>
                                          <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600" x-show="option.selected">
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                              viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                              <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                            </svg>
                                          </span>
                                        </div>
                                      </div>
                                    </div>
                                  </li>
                                </template>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @push('scripts')
    <script>
      document.addEventListener("alpine:init", () => {
        Alpine.data("alpineMuliSelect", (obj) => ({
          elementId: obj.elementId,
          options: [],
          selected: obj.selected,
          selectedElms: [],
          show: false,
          search: '',
          errorMessage: '', // Mensaje de error
          open() {
            this.show = true
          },
          close() {
            this.show = false
          },
          toggle() {
            this.show = !this.show
          },
          isOpen() {
            return this.show === true
          },

          // Inicializando componente
          init() {
            const options = document.getElementById(this.elementId).options;
            for (let i = 0; i < options.length; i++) {
              this.options.push({
                value: options[i].value,
                text: options[i].innerText,
                search: options[i].dataset.search,
                selected: Object.values(this.selected).includes(options[i].value)
              });

              if (this.options[i].selected) {
                this.selectedElms.push(this.options[i])
              }
            }

            // Buscando el valor dado
            this.$watch("search", (e => {
              this.options = []
              const options = document.getElementById(this.elementId).options;
              Object.values(options).filter((el) => {
                var reg = new RegExp(this.search, 'gi');
                return el.dataset.search.match(reg)
              }).forEach((el) => {
                let newel = {
                  value: el.value,
                  text: el.innerText,
                  search: el.dataset.search,
                  selected: Object.values(this.selected).includes(el.value)
                }
                this.options.push(newel);
              })
            }));
          },
          // Borrar campo de búsqueda
          clear() {
            this.search = ''
          },
          // Deseleccionar opciones seleccionadas
          deselect() {
            setTimeout(() => {
              this.selected = []
              this.selectedElms = []
              Object.keys(this.options).forEach((key) => {
                this.options[key].selected = false;
              })
            }, 100)
          },
          // Seleccionar opción dada
          select(index, event) {
            // Verificar si el elemento no está seleccionado y si ya se han seleccionado dos elementos
            if (!this.options[index].selected && this.selectedElms.length >= 2) {
              // Mostrar mensaje de error
              this.errorMessage = "Solo se permite seleccionar dos elementos";
              return;
            }

            // Si el elemento no está seleccionado, agregarlo a la selección
            if (!this.options[index].selected) {
              this.errorMessage = ''; // Limpiar mensaje de error si se puede seleccionar
              this.options[index].selected = true;
              this.selected.push(this.options[index].value);
              this.selectedElms.push(this.options[index]);

            } else {
              // Si el elemento está seleccionado, eliminarlo de la selección
              this.options[index].selected = false;
              this.selected = this.selected.filter(value => value !== this.options[index].value);
              this.selectedElms = this.selectedElms.filter(elm => elm.value !== this.options[index].value);
            }
          },
          // Eliminar de la opción seleccionada
          remove(index, option) {
            this.selectedElms.splice(index, 1);

            Object.keys(this.options).forEach((key) => {
              if (this.options[key].value == option.value) {
                this.options[key].selected = false;

                Object.keys(this.selected).forEach((skey) => {
                  if (this.selected[skey] == option.value) {
                    this.selected.splice(skey, 1);
                  }
                })
              }
            })
          },
          // Filtrando elementos seleccionados
          selectedElements() {
            return this.options.filter(op => op.selected === true)
          },
          // Obteniendo valores seleccionados
          selectedValues() {
            return this.options.filter(op => op.selected === true).map(el => el.value)
          }
        }));
      });
    </script>
  @endpush
</x-app-layout>