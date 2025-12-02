import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'neu-base': '#E0E5EC',
                'neu-text': '#4A5568',
                'neu-text-dark': '#2D3748',
            },
            boxShadow: {
                'neu-out': '9px 9px 16px rgb(163,177,198,0.6), -9px -9px 16px rgba(255,255,255, 0.5)',
                'neu-in': 'inset 6px 6px 10px 0 rgba(163,177,198, 0.7), inset -6px -6px 10px 0 rgba(255,255,255, 0.8)',
                'neu-pressed': 'inset 4px 4px 8px 0 rgba(163,177,198, 0.7), inset -4px -4px 8px 0 rgba(255,255,255, 0.8)',
            },
        },
    },

    plugins: [forms],
};
