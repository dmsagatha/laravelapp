<nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="https://laravel.com/" target="_blank" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="{{ asset('images/logoLaravel.min.svg') }}" class="h-8" alt="Flowbite Logo" />
      <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Laravel 11</span>
    </a>
    <!-- Right navigation links -->
    <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
      <x-theme-switcher class="pl-7" />

      <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
        <span class="sr-only">Open user menu</span>
        <img class="w-8 h-8 rounded-full" src="{{ asset('images/noavatar.png') }}" alt="user photo">
      </button>
      <!-- Dropdown menu -->
      <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
        <div class="px-4 py-3">
          <span class="block text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
          <span class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
        </div>
        <ul class="py-2" aria-labelledby="user-menu-button">
          <x-dropdown--link :href="route('profile.edit')">
            {{ __('Profile') }}
          </x-dropdown--link>

          <!-- Authentication -->
          <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-dropdown--link :href="route('logout')"
                onclick="event.preventDefault();
                this.closest('form').submit();">
              {{ __('Log Out') }}
            </x-dropdown--link>
          </form>
        </ul>
      </div>
      {{-- Button to collapse the menu --}}
      <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"  stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
        </svg>
      </button>
    </div>
    <!-- Centered navigation links -->
    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
      <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
          {{ __('Dashboard') }}
        </x-nav-link>
        <!-- Dropdown menu -->
        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">
          Varios temas
          <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
          </svg>
        </button>
        <div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
          <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
            <x-dropdown--link :href="route('users.index')">
              Eliminación masiva
            </x-dropdown--link>
            <x-dropdown--link :href="route('users.select2JQ')">
              Select2 Simple y Múltiple
            </x-dropdown--link>
            <li aria-labelledby="dropdownNavbarLink">
              <button id="doubleDropdownButton" data-dropdown-toggle="doubleDropdown" data-dropdown-placement="right-start" type="button" class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                DataTables
                <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
              </button>
              <div id="doubleDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="doubleDropdownButton">
                  <x-dropdown--link :href="route('users.dataTablesJQ')">
                    DataTables.Net
                  </x-dropdown--link>
                  <x-dropdown--link :href="route('users.dtTailwindcss')">
                    DataTables.Net y Tailwind CSS
                  </x-dropdown--link>
                </ul>
              </div>
            </li>
          </ul>
        </div>
        <x-nav-link :href="route('processors.index')" :active="request()->routeIs('processors.index')">
          CRUD e Importar Procesadores
        </x-nav-link>
        <x-nav-link :href="route('memories.index')" :active="request()->routeIs('memories.index')">
          Selects | Constantes
        </x-nav-link>
      </ul>
    </div>
  </div>
</nav>