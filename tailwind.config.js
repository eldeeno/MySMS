import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    daisyui: {
        themes: [
            {
                mytheme: {
                    "primary": "#34d399",
                    "secondary": "#a7f3d0",
                    "accent": "#f3f4f6",
                    "neutral": "#d1d5db",
                    "base-100": "#FFFFFF",
                    "info": "#3ABFF8",
                    "success": "#36D399",
                    "warning": "#ea580c",
                    "error": "#dc2626",
                },
            },
        ],
        styled: true,
        // themes: false,
        base: true,
        utils: true,
        logs: true,
        prefix: "",
        darkTheme: "light",
    },
    plugins: [require("daisyui"), forms],
};
