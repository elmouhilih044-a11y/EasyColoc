import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    safelist: [
        'bg-[#0D0D0D]',
        'bg-[#F2F2F2]',
        'bg-[#9A8FA6]',
        'bg-[#544D59]',
        'bg-[#E5D0F2]',
        'text-[#0D0D0D]',
        'text-[#F2F2F2]',
        'text-[#9A8FA6]',
        'text-[#544D59]',
        'text-[#E5D0F2]',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};