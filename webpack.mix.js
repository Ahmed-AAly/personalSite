const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps()
    .version();
mix.postCss('resources/css/nes.css', 'public/css').version();
mix.postCss('resources/css/custom.css', 'public/css').version();
mix.copyDirectory('resources/fonts', 'public/fonts').version();
mix.copyDirectory('resources/img', 'public/img').version();
mix.js('resources/js/customJS.js', 'public/js').version();
mix.js('resources/js/ckeditor5.js', 'public/js').version();
mix.js('resources/js/chartjs.js', 'public/js').version();