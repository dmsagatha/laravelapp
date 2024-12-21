@props(['type', 'message', 'position' => 'top-right'])

{{-- @php
  $typeClasses = [
      'success' => 'bg-success-500 text-slate-50 border-success-700',
      'info' => 'bg-info-500 text-slate-50 border-info-700',
      'error' => 'bg-error-500 text-slate-50 border-error-700',
      'warning' => 'bg-warning-500 text-slate-50 border-warning-700',
  ][$type] ?? 'bg-slate-100 border border-slate-400 text-slate-700';

  $positionClasses = [
      'bottom-right' => 'bottom-4 right-4',
      'bottom-left' => 'bottom-4 left-4',
      'top-right' => 'top-28 right-4',
      'top-left' => 'top-28 left-4',
  ][$position] ?? 'top-28 right-4';
@endphp

<div x-data="{ show: true }" x-show="show" class="fixed {{ $positionClasses }} {{ $typeClasses }} border px-4 py-3 rounded cursor-pointer" role="alert">
  <span class="block sm:inline">{{ $message }}</span>
  <span class="absolute top-0 bottom-0 right-0 px-10 py-3" @click="show = false">
    <svg class="fill-current h-6 w-6 text-' . $type . '-800" role="button" xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 20 20">
      <title>Close</title>
      <path
        d="M14.348 5.652a1 1 0 10-1.414-1.414L10 7.172 7.066 4.238a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 12.828l2.934 2.934a1 1 0 101.414-1.414L11.414 10l2.934-2.934z" />
    </svg>
  </span>
</div> --}}

@php
  $positionClasses = [
    'bottom-right' => 'bottom-4 right-4',
    'bottom-left' => 'bottom-4 left-4',
    'top-right' => 'top-28 right-4',
    'top-left' => 'top-28 left-4',
  ][$position] ?? 'top-28 right-4';
@endphp

<div x-data="{show: true}" x-show="show" class="fixed top-32 right-4 z-50 space-y-2 px-4 py-2 rounded shadow-lg transition-all duration-500">
  <div class="{{ $backgroundCSS() }} w-full rounded-xl p-2">
    <div class="mt-4">
      {{ $message }}
    </div>
    <button class="mt-8 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900  focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled: opacity-25 transition ease-in-out duration-150" x-on:click="show = false">
      Cerrar
    </button>
  </div>
</div>

{{-- <div class="fixed top-32 right-5 z-50 max-w-[30rem] rounded-xl">
  <div class="flex w-full items-start gap-4 rounded border border-cyan-100 bg-cyan-50 px-4 py-3 text-sm text-cyan-500" role="alert">
    <!-- Icon -->
    <svg xmlns="http://www.w3.org/2000/svg" class="size-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" role="graphics-symbol" aria-labelledby="title-08 desc-08">
      <title id="title-08">Icon title</title>
      <desc id="desc-08">A more detailed description of the icon</desc>
      <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
    </svg>
    <svg class="fill-current h-6 w-6 text-{{ $type }}-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
      <title>Close</title>
      <path d="M14.348 5.652a1 1 0 10-1.414-1.414L10 7.172 7.066 4.238a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 12.828l2.934 2.934a1 1 0 101.414-1.414L11.414 10l2.934-2.934z" />
    </svg>
    <!-- Text -->
    <div>
      <h3 class="mb-2 font-semibold">All components are now live.</h3>
      <p>You successfully read this important alert message. Blue often indicates a neutral informative change or action.</p>
    </div>
  </div>
</div> --}}