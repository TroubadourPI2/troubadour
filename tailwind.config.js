import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue'
    ],
    theme: {
        extend: {
            colors: {
                c1: '#154C51',
                c2: '#C8E3DF',
                c3: '#FBFBFB',
                c4: '#e3c8cc',
                c5 : '#8F0005'
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                barlow: ['"Barlow Semi Condensed"', ...defaultTheme.fontFamily.sans],
            }
        }
    },
    plugins: []
};
