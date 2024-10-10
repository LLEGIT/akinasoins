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
                  customRed: '#E49696',  // Nom de ta couleur personnalisée
                },
            },
    },
    plugins: [],
}
