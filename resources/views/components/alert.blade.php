@props(['type', 'message', 'dismissible' => true, 'closeSelf' => 0])

@php
  $dismissible = filter_var($dismissible, FILTER_VALIDATE_BOOLEAN);
  $typeClasses =
      [
          'success' => 'text-rose-900 bg-rose-100 border border-rose-300',
          'danger' => 'text-red-900 bg-red-100 border border-red-300',
          'info' => 'text-sky-900 bg-sky-100 border border-sky-300',
          'warning' => 'text-orange-900 bg-orange-100 border border-orange-300',
      ][$type] ?? 'text-sky-900 bg-sky-100 border border-sky-300';
@endphp

<div x-data="{ open: true }" x-show="open" x-transition.duration.300ms
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

      @if($dismissible)
        <button @click="open = false" class="ml-auto">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
      @endif
    </div>
    <!-- Component End  -->
  </div>
</div>
