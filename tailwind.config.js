module.exports = {
  theme: {
    extend: {
      colors: {
        primary: {
          '500': '#262431',
        },
        secondary: {
          '500': '#ea2466',
        },
      },
    },
  },
  variants: {},
  plugins: [
      require('@tailwindcss/ui')
  ]
}
