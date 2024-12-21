@props(['type', 'message', 'position' => 'top-right'])

@php
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
</div>