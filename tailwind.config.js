/** @type {import('tailwindcss').Config} */
export default {
  // purge: ['.public//index.html', './resources/js/**/*.{vue,js,ts,jsx,tsx}'],
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'primary': {
          '50':  '#f0fdf4',
          '100': '#dcfce7',
          '200': '#bbf7d0',
          '300': '#86efac',
          '400': '#4ade80',
          '500': '#22c55e',
          '600': '#16a34a',
          '700': '#15803d',
          '800': '#166534',
          '900': '#14532d',
          '950': '#052e16',
        },
      },

      'keyframes': {
        'shimmer': {
          '100%': {
            "transform": "translateX(100%)",
          },
        },
      }

    },

  },
  plugins: [
    require('@tailwindcss/forms'),
  ],


}

