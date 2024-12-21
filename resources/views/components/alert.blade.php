@props(['type' => 'success', 'message', 'position' => 'top-right'])

@php
  $typeClasses = [
      'success' => 'bg-green-500 text-slate-50 border-green-700',
      'info' => 'bg-blue-500 text-slate-50 border-blue-700',
      'error' => 'bg-red-500 text-slate-50 border-red-700',
      'warning' => 'bg-yellow-500 text-slate-50 border-yellow-700',
  ][$type];

  $positionClasses = [
      'bottom-right' => 'bottom-4 right-4',
      'bottom-left' => 'bottom-4 left-4',
      'top-right' => 'top-28 right-4',
      'top-left' => 'top-28 left-4',
  ][$position];
@endphp

<div class="{{ $positionClasses }} fixed cursor-pointer" x-data="{ show: true }" x-show="show" @click="show=false">
  <div class="{{ $typeClasses }} max-w-md text-white rounded-lg px-4 py-2">
    {{ $message }}
    <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="show = false">
      <svg class="fill-current h-6 w-6 text-{{ $type }}-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
        <title>Close</title>
        <path d="M14.348 5.652a1 1 0 10-1.414-1.414L10 7.172 7.066 4.238a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 12.828l2.934 2.934a1 1 0 101.414-1.414L11.414 10l2.934-2.934z" />
      </svg>
    </span>
  </div>
</div>

<div x-data="{ show: true }" x-show="show"
  class="bg-{{ $type }}-100 border border-{{ $type }}-400 text-{{ $type }}-700 px-4 py-3 rounded relative"
  role="alert">
  <span class="block sm:inline">{{ $message }}</span>
  <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="show = false">
    <svg class="fill-current h-6 w-6 text-{{ $type }}-500" role="button" xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 20 20">
      <title>Close</title>
      <path
        d="M14.348 5.652a1 1 0 10-1.414-1.414L10 7.172 7.066 4.238a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 12.828l2.934 2.934a1 1 0 101.414-1.414L11.414 10l2.934-2.934z" />
    </svg>
  </span>
</div>
