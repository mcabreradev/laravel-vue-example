var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    // compile sass
    mix.sass(['app.scss'],'public/compiled/css');

    // jQuery
    mix.copy('node_modules/jquery/dist', 'public/compiled/js/jquery');

    // Bootstrap
    mix.copy('node_modules/bootstrap/dist', 'public/compiled/css/bootstrap');

    // Copy assets from admin-lte theme
    mix.copy('node_modules/admin-lte/dist/js', 'public/compiled/js/admin-lte');

    // SweetAlert
    mix.copy('node_modules/sweetalert/dist/', 'public/compiled/js/sweetalert');
});
