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
    class="ms-auto -mx-1.5 -my-1.5 {{ $typeClasses }} rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700 border-none" aria-label="Close">
    <svg class="fill-current h-6 w-6 text-{{ $type }}-500" role="button" xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 20 20">
      <title>Close</title>
      <path d="M14.348 5.652a1 1 0 10-1.414-1.414L10 7.172 7.066 4.238a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 12.828l2.934 2.934a1 1 0 101.414-1.414L11.414 10l2.934-2.934z" />
    </svg>
  </button>
</div>