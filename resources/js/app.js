import Alpine from 'alpinejs'
import focus from '@alpinejs/focus'
import 'flowbite'

window.Alpine = Alpine

Alpine.plugin(focus)
Alpine.start()

// Tailwind CSS Dark/Light Mode
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