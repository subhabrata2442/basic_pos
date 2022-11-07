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


mix.js('resources/assets/admin/js/app.js', 'public/assets/admin/js')
    .postCss('resources/assets/admin/css/app.css', 'public/assets/admin/css', [
        //
    ]);
mix.js('resources/assets/front/js/app.js', 'public/assets/front/js')
    .postCss('resources/assets/front/css/app.css', 'public/assets/front/css', [
        //
    ]);
mix.disableNotifications();