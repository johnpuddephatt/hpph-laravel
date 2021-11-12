module.exports = {
  mode: 'jit',
  content: ['safelist.txt', './app/**/*.php', './resources/**/*.{php,vue,js}'],
  corePlugins: {
    // ...
    container: false,
  },
  theme: {
    extend: {
      colors: {
        'christmas-beige': '#e0dbd7',
        'christmas-red': '#c4382c',
        'christmas-blue': '#4186c3',
      },
      fontFamily: {
        sans: ['HPPHA'],
        serif: ['HPPHB'],
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
  experimental: {
    optimizeUniversalDefaults: true,
  },
  corePlugins: {
    preflight: false,
  },
};
