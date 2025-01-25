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
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require("@tailwindcss/typography"), require("daisyui"), forms],

    daisyui: {
        themes: [
            {
                tomyam: {
                    primary: "#F46E05", // Tom Yum spicy red
                    secondary: "#6A4C3C", // Earthy brown (representing rustic flavors)
                    accent: "#FFB84C", // Golden yellow (lightened slightly for contrast)
                    neutral: "#F9F9F9", // Soft off-white for better contrast and readability
                    "base-100": "#FFFFFF", // White background for clean, bright UI
                    info: "#0090B5", // Cool blue (for a refreshing contrast)
                    success: "#2A9D8F", // Fresh herb green (symbolizing freshness and herbs)
                    warning: "#FF7043", // Slightly muted, softer orange for a balanced warning
                    error: "#FC5858", // Bright red (remains bold for alerts)
                },
            },

            {
                dark: {
                    primary: "#D87A3D", // Darker reddish-golden color for primary
                    secondary: "#6A4C3C", // Dark brown (more contrast in dark mode)
                    accent: "#D65A1E", // Deep reddish-orange for accent (complementary to primary)
                    neutral: "#1F2937", // Lighter dark grayish-blue (subtle background)
                    "base-100": "#111827", // Darker grayish-blue for primary background
                    info: "#0090B5", // Cool blue (remains for dark mode)
                    success: "#2A9D8F", // Herb green
                    warning: "#FF7043", // Lighter warning orange for visibility in dark mode
                    error: "#FF5252", // Lighter red for error in dark mode
                },
            },
        ],
    },
};
