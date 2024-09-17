<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body class="font-sans text-slate-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-50 dark:bg-slate-900">
      <div>
        <x-theme-switcher />
        
        <a href="/">
          <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </a>
      </div>

      <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>

    <script>
        const themeToggleBtn = document.getElementById('theme-toggle');
        const htmlElement = document.documentElement;

        // Verificar si hay un tema guardado en localStorage
        if (localStorage.getItem('theme') === 'dark') {
            htmlElement.classList.add('dark');
            document.getElementById('icon-sun').classList.remove('hidden');
            document.getElementById('icon-moon').classList.add('hidden');
        }

        themeToggleBtn.addEventListener('click', function () {
            if (htmlElement.classList.contains('dark')) {
                htmlElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
                
                // Mostrar luna, ocultar sol
                document.getElementById('icon-sun').classList.add('hidden');
                document.getElementById('icon-moon').classList.remove('hidden');
            } else {
                htmlElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
                
                // Mostrar sol, ocultar luna
                document.getElementById('icon-sun').classList.remove('hidden');
                document.getElementById('icon-moon').classList.add('hidden');
            }
        });
    </script>

    @stack('scripts')
  </body>
</html>