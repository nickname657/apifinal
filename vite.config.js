import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import postcss from 'postcss';
import tailwindcss from 'tailwindcss';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        postcss({
            plugins: [
                tailwindcss,
            ],
        }),
    ],
});
