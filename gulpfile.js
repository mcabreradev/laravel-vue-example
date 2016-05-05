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

    // Copy assets from admin-lte theme
    mix.copy('node_modules/admin-lte/dist/js', 'public/compiled/js/admin-lte');
});
