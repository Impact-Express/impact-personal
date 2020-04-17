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
    .js('resources/js/tooltip.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/personal.master.scss', 'public/css')
    .sass('resources/sass/personal.stage1.scss', 'public/css')
    .sass('resources/sass/personal.stage2.scss', 'public/css')
    .sass('resources/sass/personal.stage3.scss', 'public/css')
    .sass('resources/sass/personal.stage4.scss', 'public/css')
    .sass('resources/sass/personal.stage5.scss', 'public/css')
    .sass('resources/sass/hermesparcelshop.scss', 'public/css')
    .sass('resources/sass/register.scss', 'public/css')
    .sass('resources/sass/login.scss', 'public/css')
    .sass('resources/sass/complete.scss', 'public/css');
