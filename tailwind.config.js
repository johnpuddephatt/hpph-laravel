module.exports = {
  mode: 'jit',
  purge: ['safelist.txt', './app/**/*.php', './resources/**/*.{php,vue,js}'],
  darkMode: false, // or 'media' or 'class'
  corePlugins: {
    // ...
    container: false,
  },
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [],
};
