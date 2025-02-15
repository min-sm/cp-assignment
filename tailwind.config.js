import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'honeydew': '#CBD2A4',
                'mocha': '#9A7E6F',
                'charcoal': '#54473F',
                'ivory': '#ECEBE6',
                'baby-blue': '#BFD7ED',
                'blue-grotto': '#43B0F1',
                'royal-blue': '#0074B7',
                'navy-blue': '#003B73',

            },
        },
    },
    plugins: [require('flowbite/plugin')],
};
