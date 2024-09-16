import Alpine from 'alpinejs';
import 'flowbite';

window.Alpine = Alpine;

Alpine.start();

// Icons
const sunIcon = document.querySelector('.sun');
const moonIcon = document.querySelector('.moon');

// Theme Vars
const userTheme = localStorage.getItem('theme');
const systemTheme = window.matchMedia('(prefers-color-scheme: dark').matches;

// Icon Toggling
const iconToggle = () => {
  sunIcon.classList.toggle('display-none');
  moonIcon.classList.toggle('display-none');
};

// Initial Theme Dark
const themeCheck = () => {
  if (userTheme === 'dark' || (!userTheme && systemTheme)) {
    document.documentElement.classList.add('dark');
    moonIcon.classList.add('display-none');
    return;
  }
  sunIcon.classList.add('display-none');
};

// Manual Theme Switch
const themeSwitch = () => {
  if (document.documentElement.classList.contains('dark')) {
    document.documentElement.classList.remove('dark');
    localStorage.setItem('theme', 'light');
    iconToggle;
    return;
  }
  document.documentElement.classList.add('dark');
  localStorage.setItem('theme', 'dark');
  iconToggle;
};

// Call theme Switch on clicking buttons
sunIcon.addEventListener('click', () => {
  themeSwitch;
});

moonIcon.addEventListener('click', () => {
  themeSwitch;
});

// Invoke Theme check on initial load
themeSwitch;


// recupera el modo desde localStorage cuando la pagina carga la primera vez
if (localStorage.theme === 'dark' || (!'theme' in localStorage && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
  document.querySelector('html').classList.add('dark')
} else if (localStorage.theme === 'dark') {
  document.querySelector('html').classList.add('dark')
}

// Evento click de los botones.
// Agreag la clase 'dark' al elemento html
// guarda o elimina el modo del localstorage 
document.querySelectorAll(".setMode").forEach(item => 
  item.addEventListener("click", () => {
      let htmlClasses = document.querySelector('html').classList;
      if(localStorage.theme == 'dark') {
          htmlClasses.remove('dark');
          localStorage.theme = ''
      } else {
          htmlClasses.add('dark');
          localStorage.theme = 'dark';
      }
  })
)