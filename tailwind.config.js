/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                'ruddyPink': '#E49696',
                'tealDeer': '#96E4B9',
                'pastelGray': '#CACCC5',
                'cornFlower': '#96CDE4',
            }
        },
    },
    plugins: [],
}
