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
    .sass('resources/sass/app.scss', 'public/css');

mix.styles([
    'resources/assets/css/sb-admin-2.css',
    'resources/assets/css/all.css',
    // 'resources/assets/css/dropzone.css',
    'resources/assets/css/dataTables.bootstrap4.css',
], 'public/css/libs.css');

mix.scripts([
    'resources/assets/js/jquery.min.js',
    'resources/assets/js/bootstrap.bundle.min.js',
    'resources/assets/js/jquery.easing.min.js',
    'resources/assets/js/sb-admin-2.js',
    'resources/assets/js/all.min.js',
    // 'resources/assets/js/dropzone.js',
    'resources/assets/js/jquery.dataTables.js',
    'resources/assets/js/dataTables.bootstrap4.js',
    'resources/assets/js/sweetalert2.all.min.js'
], 'public/js/libs.js');