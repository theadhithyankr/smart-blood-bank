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
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                mono: ['JetBrains Mono', ...defaultTheme.fontFamily.mono],
            },
            colors: {
                surface: {
                    DEFAULT: '#0f1117',
                    card:    '#171b26',
                    raised:  '#1e2333',
                    border:  '#252a3a',
                    hover:   '#2a3045',
                },
                brand: {
                    DEFAULT: '#e63946',
                    soft:    '#ff6b6b',
                    dim:     '#3d1419',
                },
                ink: {
                    DEFAULT: '#e8eaf0',
                    muted:   '#8b92a9',
                    faint:   '#4a5068',
                },
                ok:   '#22c55e',
                warn: '#f59e0b',
                danger: '#ef4444',
            },
            boxShadow: {
                'card': '0 1px 3px 0 rgba(0,0,0,0.4), 0 0 0 1px rgba(255,255,255,0.04)',
                'card-hover': '0 4px 20px rgba(0,0,0,0.5), 0 0 0 1px rgba(255,255,255,0.06)',
                'brand-glow': '0 0 24px rgba(230,57,70,0.2)',
            },
        },
    },

    plugins: [forms],
};
