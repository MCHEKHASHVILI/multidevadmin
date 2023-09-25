import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        'node_modules/flowbite-vue/**/*.{js,jsx,ts,tsx}',
        'node_modules/flowbite/**/*.{js,jsx,ts,tsx}',
    ],

    theme: {
        extend: {
            container: {
                screens: {
                  sm: "640px",
                  md: "768px",
                  lg: "1024px",
                  xl: "1280px",
                  '2xl': '1536px',
                  '3xl': '1848px',
                },
                padding: {
                  DEFAULT: '1rem',
                  sm: '2rem',
                  md: '2.5rem',
                  lg: '4rem',
                  xl: '5rem',
                  '2xl': '6rem',
                  '3xl': '6.5rem',
                },
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, require('flowbite/plugin')],
};
