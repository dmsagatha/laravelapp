@props(['type', 'message', 'dismissible' => true, 'closeSelf' => 0])

@php
  $dismissible = filter_var($dismissible, FILTER_VALIDATE_BOOLEAN);
  $typeClasses =
      [
          'success' => 'text-blue-800 bg-blue-100 dark:bg-gray-800 dark:text-blue-400 border border-blue-300',
          'danger' => 'text-red-800 bg-red-100 dark:bg-gray-800 dark:text-red-400 border border-red-300',
          'info' => 'text-sky-800 bg-sky-100 dark:bg-gray-800 dark:text-sky-400 border border-sky-300',
          'warning' => 'text-yellow-800 bg-yellow-100 dark:bg-gray-800 dark:text-yellow-400 border border-yellow-300',
      ][$type] ?? 'text-sky-800 bg-sky-100 dark:bg-gray-800 dark:text-sky-400 border border-sky-300';
@endphp

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

<div x-data="{ open: true }" x-show="open" x-transition.duration.300ms
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
</div>