@props(['type', 'message', 'duration' => 5000])

@php
  $typeClasses =
    [
        'success' => 'text-success-800 bg-success-100 dark:bg-gray-800 dark:text-success-400 border border-success-300',
        'info' => 'text-info-800 bg-info-100 dark:bg-gray-800 dark:text-info-400 border border-info-300',
        'warning' => 'text-warning-800 bg-warning-100 dark:bg-gray-800 dark:text-warning-400 border border-warning-300',
        'danger' => 'text-danger-800 bg-danger-100 dark:bg-gray-800 dark:text-danger-400 border border-danger-300',
    ][$type] ?? 'text-info-800 bg-info-100 dark:bg-gray-800 dark:text-info-400 border border-info-300';
@endphp

<div x-data="{ show: true }" x-init="setTimeout(() => show = false, {{ $duration }})" x-show="show"
  class="flex items-center p-4 mb-4 fixed top-24 right-4 {{ $typeClasses }} rounded-lg" role="alert">
  <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
  </svg>
  <span class="sr-only">{{ $type }}</span>
  <div class="ms-3 text-sm font-semibold">
    {{ $message }}
  </div>
  <button @click="open = false" type="button"
    class="ms-auto -mx-1.5 -my-1.5 {{ $typeClasses }} rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700 border-none"
    aria-label="Close">
    <svg class="fill-current h-6 w-6 text-{{ $type }}-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
      <title>Close</title>
      <path d="M14.348 5.652a1 1 0 10-1.414-1.414L10 7.172 7.066 4.238a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 12.828l2.934 2.934a1 1 0 101.414-1.414L11.414 10l2.934-2.934z" />
    </svg>
  </button>
</div>

{{-- <div x-data="{ open: true }" x-show="open" x-transition.duration.300ms
  @if ($closeSelf > 0) x-init="setTimeout(() => open = false, {{ $closeSelf }})" @endif
  class="flex items-center p-4 mb-4 fixed top-24 right-4 {{ $typeClasses }} rounded-lg" role="alert">
  <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
  </svg>
  <span class="sr-only">Info</span>
  <div class="ms-3 text-sm font-semibold">
    {{ $message }}
  </div>
  @if ($dismissible)
    <button @click="open = false" type="button"
      class="ms-auto -mx-1.5 -my-1.5 {{ $typeClasses }} rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700 border-none"
      aria-label="Close">
      <span class="sr-only">Close</span>
      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
      </svg>
    </button>
  @endif
</div> --}}

{{-- <div x-data="{ open: true }" x-show="open" x-transition.duration.300ms
  @if ($closeSelf > 0)
    x-init="setTimeout(() => open = false, {{ $closeSelf }})"
  @endif
  class="flex flex-wrap items-center justify-center fixed top-32 right-4 space-y-4 z-50">
  <div class="flex flex-wrap items-center justify-center w-full max-w-sm space-x-5 shadow-[0.8rem_1rem_0.5rem_rgba(0,0,0,0.1)]">
    <!-- Component Start -->
    <div class="flex items-center h-16 pr-4 w-full max-w-md shadow-lg {{ $typeClasses }}">
      <div class="flex items-center justify-center w-12 h-full">
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
          <path fill="currentColor"
            d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10s10-4.5 10-10S17.5 2 12 2m-2 15l-5-5l1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9Z" />
        </svg>
      </div>
      <div class="px-6">
        {{ $message }}
      </div>

      @if ($dismissible)
        <button @click="open = false" class="ml-auto">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
      @endif
    </div>
    <!-- Component End  -->
  </div>
</div> --}}


<!-- Contenedor de alertas -->
{{-- <div class="relative text-sm font-medium leading-6">
    <div
    class="absolute -top-14 right-0 w-full max-w-sm shadow-[0.8rem_1rem_0.5rem_rgba(0,0,0,0.1)] bg-white rounded-lg">
    <!-- Icono de marca de verificación -->
    <div class="flex items-center justify-between p-2">
        <div class="text-green-500 text-2xl">
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
            <path fill="currentColor"
            d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10s10-4.5 10-10S17.5 2 12 2m-2 15l-5-5l1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9Z" />
        </svg>
        </div>
        <!-- Mensaje de alerta -->
        <h2 class="text-sm text-green-500 font-semibold">
        Your object was successfully created
        </h2>
        <!-- Icono de cerrar -->
        <div class="close">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-7 rounded cursor-pointer feather feather-x"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
        </div>
    </div>
    </div>
</div> --}}
