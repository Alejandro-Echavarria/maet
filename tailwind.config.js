import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",

    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
        "node_modules/flowbite-vue/**/*.{js,jsx,ts,tsx}",
        "node_modules/flowbite/**/*.{js,jsx,ts,tsx}",
    ],

    safelist: [
        {
            pattern:
                /(bg|from|via|to|text|border)-(gray|slate|red|orange|yellow|teal|purple|pink|indigo|green|blue)-(100|200|300|400|500|600|700|800|900)/,
        },
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Inter", ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                'fade-in-up': {
                    "from": {
                        transform: "translateY(0.75rem)",
                        opacity: '0'
                    },
                    "to": {
                        transform: "translateY(0rem)",
                        opacity: '1'
                    }
                },
                'fade-in-down': {
                    "from": {
                        transform: "translateY(-0.75rem)",
                        opacity: '0'
                    },
                    "to": {
                        transform: "translateY(0rem)",
                        opacity: '1'
                    }
                },
                'fade-in': {
                    "from": {
                        opacity: '0'
                    },
                    "to": {
                        opacity: '1'
                    }
                },
                'fade-in-right': {
                    "from": {
                        transform: "translateX(-1.5rem)",
                        opacity: '0'
                    },
                    "to": {
                        transform: "translateX(0rem)",
                        opacity: '1'
                    },
                },
                'fade-in-left': {
                    "from": {
                        transform: "translateX(1.5rem)",
                        opacity: '0'
                    },
                    "to": {
                        transform: "translateX(0rem)",
                        opacity: '1'
                    }
                },
            },
            animation: {
                'fade-in-up': "fade-in-up 0.4s ease-in-out both",
                'fade-in-down': "fade-in-down 0.4s ease-in-out both",
                'fade-in': "fade-in 0.4s ease-in-out both",
                'fade-in-right': "fade-in-right 0.4s ease-in-out both",
                'fade-in-left': "fade-in-left 0.4s ease-in-out both",
            }
        },
    },

    plugins: [forms, typography, require("flowbite/plugin")],
};
