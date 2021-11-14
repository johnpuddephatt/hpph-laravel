module.exports = {
  mode: 'jit',
  content: ['safelist.txt', './app/**/*.php', './resources/**/*.{php,vue,js}'],

  theme: {
    extend: {
      colors: {
        'christmas-beige': '#e0dbd7',
        'christmas-red': '#c4382c',
        'christmas-blue': '#4186c3',
        'smoke-900': 'rgba(0, 0, 0, 0.9)',
        'smoke-800': 'rgba(0, 0, 0, 0.75)',
        'smoke-600': 'rgba(0, 0, 0, 0.6)',
        smoke: 'rgba(0, 0, 0, 0.5)',
        'smoke-400': 'rgba(0, 0, 0, 0.4)',
        'smoke-200': 'rgba(0, 0, 0, 0.25)',
        'smoke-100': 'rgba(0, 0, 0, 0.1)',
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
    container: false,
  },
};
