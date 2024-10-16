<button
  {{ $attributes->merge(['type' => 'button', 'class' => 'relative inline-flex items-center justify-center text-blue-800 hover:text-slate-50 border border-blue-500 hover:bg-blue-700 focus:ring-1 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-2 py-2 mr-2 mb-2 text-center text-sm dark:border-slate-500 dark:text-slate-400 dark:hover:text-slate-50 dark:hover:bg-blue-600 dark:focus:ring-blue-800']) }}>
  {{ $slot }}
</button>