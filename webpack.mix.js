const { mix } = require('laravel-mix');

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

mix.js([
    'resources/assets/js/plugins/sweetalert.min.js',
    'resources/assets/js/plugins/toastr.min.js',
    'resources/assets/js/plugins/dropzone.min.js'
], 'public/js/plugins.js')
   .sass('resources/assets/sass/app.scss', 'public/css/admin.css');
