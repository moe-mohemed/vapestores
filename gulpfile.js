

const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix.sass('app.scss')
    .webpack('app.js')
    .scripts([
        'libs/sly.js',
        'libs/sweetalert-dev.js',
        'libs/lity.js',
        'libs/scripts.js',
        'libs/lightbox.min.js',
    ], './public/js/libs.js')
    .styles([
        'sweetalert.css',
        'lity.css'
    ], './public/css/libs.css')
    .browserSync({
        proxy: 'www.vapestoremaps.com'
    });
});


