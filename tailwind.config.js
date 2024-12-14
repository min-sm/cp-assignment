import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
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
                'ivory': '#E9EED9',
                'honeydew': '#CBD2A4',
                'mocha': '#9A7E6F',
                'charcoal': '#54473F',
            },
        },
    },
    plugins: [require('flowbite/plugin')],
};
