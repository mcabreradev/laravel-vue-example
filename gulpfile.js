'use strict';

var fs = require('fs');
var gulp = require('gulp');
var elixir = require('laravel-elixir');

var modernizr = require('modernizr');
var modernizrConfig = require('./modernizr-config'); // path to JSON config

gulp.task( 'modernizr', function (done) {
  modernizr.build(modernizrConfig, function(code) {
    fs.writeFile('./public/compiled/js/modernizr/modernizr-build.js', code, done);
  });
});


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
  mix.sass(['app.scss'], 'public/compiled/css');

  // jQuery
  mix.copy('node_modules/jquery/dist', 'public/compiled/js/jquery');

  // Bootstrap
  mix.copy('node_modules/bootstrap/dist', 'public/compiled/css/bootstrap');

  // Copy assets from admin-lte theme
  mix.copy('node_modules/admin-lte/dist/js', 'public/compiled/js/admin-lte');

  // SweetAlert
  mix.copy('node_modules/sweetalert/dist', 'public/compiled/js/sweetalert');

  // Dropzone
  mix.copy('node_modules/dropzone/dist/min/', 'public/compiled/js/dropzone');

  // Leaflet
  mix.copy('node_modules/leaflet/dist', 'public/compiled/js/leaflet');
  mix.copy('node_modules/leaflet-plugins/layer', 'public/compiled/js/leaflet/layer');

  // momentjs
  mix.copy('node_modules/moment/min', 'public/compiled/js/momentjs');

  // https://github.com/T00rk/bootstrap-material-datetimepicker
  mix.copy('bower_components/bootstrap-material-datetimepicker', 'public/compiled/js/bootstrap-material-datetimepicker');

  // modernizr
  mix.copy('modernizr-config.json', 'public/compiled/js/modernizr/modernizr-config.json');
  mix.task('modernizr');

});
