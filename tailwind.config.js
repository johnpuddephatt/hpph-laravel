module.exports = {
  mode: 'jit',
  content: ['safelist.txt', './app/**/*.php', './resources/**/*.{php,vue,js}'],
  corePlugins: {
    // ...
    container: false,
  },
  theme: {
    extend: {
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
