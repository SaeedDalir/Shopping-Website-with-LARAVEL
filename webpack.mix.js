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

mix.js('resources/js/app.js', 'public/backend/js');

mix.styles(['resources/backend/dropzone/css/dropzone.min.css'],'public/backend/dist/css/dropzone.css')
    .scripts(['resources/backend/dropzone/js/dropzone.min.js'],'public/backend/dist/js/dropzone.js')
