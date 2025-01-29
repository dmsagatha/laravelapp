import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        host: true,
        port: 5174, // Asegúrate de que coincide con VITE_PORT
        strictPort: true,
        hmr: {
            host: 'localhost',
        },
        // allowedHosts: ['laravelapp.test'], // Agrega tu dominio aquí
        allowedHosts: 'all', // Permite cualquier host
        headers: {
            'Access-Control-Allow-Origin': '*',
        },
    },
});