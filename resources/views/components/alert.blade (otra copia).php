@props([            
  'type' => 'success',
  'dismissible' => true,
  'closeSelf' => 0
])

@php
  $dismissible = filter_var($dismissible, FILTER_VALIDATE_BOOLEAN);
  $options = [
      'success' => 'text-emerald-900 bg-emerald-100 border-emerald-300',
      'danger' => 'text-red-900 bg-red-100 border-red-300',
      'info' => 'text-sky-900 bg-sky-100 border-sky-300',
      'warning' => 'text-orange-900 bg-orange-100 border-orange-300',
      'light' => 'bg-white border-gray-300',
  ];
  $style = $options[$type] ?? $options['success']
@endphp

{{-- <div
  x-data="{ open: true }"
  x-show="open"
  x-transition.duration.300ms
  @if($closeSelf > 0)
    x-init="setTimeout(() => open = false, {{ $closeSelf }})"
  @endif
  {{ $attributes->merge(['class' => "$style flex gap-4 p-4 my-4 border"]) }}>
  <div class="flex-1">
    {{ $message }}
  </div>

  @if($dismissible)
    <button class="size-6 flex-none cursor-pointer" @click="open = false">
      <svg xmlns="http://www.w3.org/2000/svg" class="size-7 rounded cursor-pointer feather feather-x" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="18" y1="6" x2="6" y2="18"></line>
        <line x1="6" y1="6" x2="18" y2="18"></line>
      </svg>
    </button>
  @endif
</div> --}}

<!-- Contenedor de alertas -->
<div
  x-data="{ open: true }"
  x-show="open"
  x-transition.duration.300ms
  @if($closeSelf > 0)
    x-init="setTimeout(() => open = false, {{ $closeSelf }})"
  @endif
  {{ $attributes->merge(['class' => "$style relative text-sm font-medium leading-6"]) }}>
  <div class="absolute -top-14 right-0 w-full max-w-sm bg-white shadow-[0.8rem_1rem_0.5rem_rgba(0,0,0,0.1)] rounded-lg">
    <!-- Icono de marca de verificación -->
    <div class="flex items-center justify-between p-2">
      <div class="text-green-500 text-2xl">
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
          <path fill="currentColor" d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10s10-4.5 10-10S17.5 2 12 2m-2 15l-5-5l1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9Z" />
        </svg>
      </div>
      <!-- Mensaje de alerta -->
      <h2 class="text-sm text-green-500 font-semibold">
        {{ $message }}
      </h2>

      <!-- Icono de cerrar -->
      @if($dismissible)
        <div class="close" @click="open = false">
          <svg xmlns="http://www.w3.org/2000/svg" class="size-7 rounded cursor-pointer feather feather-x" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </div>
      @endif
    </div>
  </div>
</div>