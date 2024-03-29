let mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
  .js("resources/js/app.js", "public/js")
  .sass("resources/sass/app.sass", "public/css")
  .sass("resources/sass/admin.scss", "public/css")
  .sass("resources/sass/spectrix.sass", "public/css")
  .version();

mix
  .sass("resources/sass/fundraising.scss", "public/css")
  .options({
    processCssUrls: false,
    postCss: [require("tailwindcss")],
  })
  .js("resources/js/fundraising.js", "public/js")
  .vue();

mix.copy("resources/images/*", "public/images");
mix.browserSync("http://public.hpph.test/");

// if (mix.inProduction()) {

// }
