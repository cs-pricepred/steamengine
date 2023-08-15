import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Instrument Sans", ...defaultTheme.fontFamily.sans],
                // sans: ["General Gothic", ...defaultTheme.fontFamily.sans],
                display: ["Disket Mono", "monospaced"],
            },
        },
        backgroundImage: {
            texture: "url('/public/images/TEXTURE 34.webp')",
        },
    },

    plugins: [forms],
};
