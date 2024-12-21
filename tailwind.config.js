import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import { info } from 'autoprefixer';
const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./node_modules/flowbite/**/*.js"
  ],

  darkMode: 'class',    // Laravel Breeze: [7] Cambiador de temas
  
  theme: {
    extend: {
      colors: {
        success: {
          100: '#d1e7dd',
          200: '#a3cfbb',
          300: '#75b799',
          400: '#489f77',
          500: '#1a8755',
          600: '#146943',
          700: '#0f4b31',
          800: '#0a2d1f',
          900: '#05100d',
        },
        info: {
          100: '#d6e4f6',
          200: '#adc9ed',
          300: '#84afe4',
          400: '#5b94db',
          500: '#3279d2',
          600: '#2861a7',
          700: '#1d487c',
          800: '#13304f',
          900: '#091724',
        },
        warning: {
          100: '#fff6d9',
          200: '#ffedb3',
          300: '#ffe48d',
          400: '#ffdb68',
          500: '#ffd342',
          600: '#ccac35',
          700: '#997728',
          800: '#66401b',
          900: '#33280d',
        },
        error: {
          100: '#f8d7da',
          200: '#f1afb5',
          300: '#ea868f',
          400: '#e35e6a',
          500: '#dc3644',
          600: '#b02c36',
          700: '#842229',
          800: '#58181b',
          900: '#2c0c0e',
        },
      },
      fontFamily: {
        sans: ['Poppins', 'sans-serif', ...defaultTheme.fontFamily.sans],
        display: ['Poppins', 'sans-serif'],
        body: ['Poppins', 'sans-serif']
      },
    },
  },

  plugins: [
    forms,
    require('flowbite/plugin'),
    require('@tailwindcss/typography'),
  ],
};