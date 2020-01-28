let mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js');
mix.sass('resources/sass/app.sass', 'public/css');
mix.sass('resources/sass/admin.scss', 'public/css');
mix.sass('resources/sass/spectrix.sass', 'public/css');

mix.copy('resources/images/*', 'public/images');
mix.browserSync('http://public.hpph-laravel.localhost/');

// if (mix.inProduction()) {
  mix.version();
// }