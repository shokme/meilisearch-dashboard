const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
  ],
  theme: {
    extend: {
      fontFamily: {
          sans: ['Raleway', ...defaultTheme.fontFamily.sans]
      },
      colors: {
        primary: {
          '300': '#53535a',
          '500': '#262431',
        },
        secondary: {
          '500': '#ea2466',
          '600': '#d21856',
          '700': '#c1134d',
        },
      },
    },
  },
  variants: {},
  plugins: [
      require('@tailwindcss/ui')
  ]
}
