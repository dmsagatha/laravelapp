<div class="mr-2 mb-1">
  <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 {{ $class ?? '' }}">
    {{ $label }}
  </label>
  <select id="{{ $id }}"
    {{ $attributes->merge(['class' => 'block py-2.5 px-0 text-xs placeholder-transparent border-b-2 border-slate-300 text-slate-800 bg-transparent dark:text-slate-400 dark:bg-slate-800 dark:border-slate-600  dark:focus:bg-slate-700 dark:focus:ring-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 p-2']) }}>
    <option selected value="">Seleccionar</option>
    {{ $slot }}
  </select>
</div>