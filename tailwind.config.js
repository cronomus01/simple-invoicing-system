/** @type {import('tailwindcss').Config} */
export default {
content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    ],
  theme: {
    extend: {
        screens: {
            print: { raw: 'print'  },
            screen: { raw: 'screen' },
        },
        gridTemplateColumns: {
          // Simple 16 column grid
          'desktop': '18em 1fr',
          'mobile': '5em 1fr',
        },
        gridTemplateRows: {
          'content': '60px 1fr',
        },

      },
  },
  plugins: [],
}

