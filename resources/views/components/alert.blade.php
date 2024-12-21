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

<div
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
</div>