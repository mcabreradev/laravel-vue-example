'use strict';

var fs = require('fs');
var gulp = require('gulp');
var elixir = require('laravel-elixir');
var shell = require('gulp-shell');
var task = elixir.Task;
var modernizr = require('modernizr');
var modernizrConfig = require('./modernizr-config'); // path to JSON config

require('laravel-elixir-vue-2');

gulp.task('modernizr', function (done) {
  modernizr.build(modernizrConfig, function (code) {
    fs.writeFile('./public/compiled/js/modernizr/modernizr-build.js', code, done);
  });
});

elixir.extend('routes', function(message) {
  return gulp.src('').pipe(shell('php artisan laroute:generate'));
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

elixir(function (mix) {
  // compile sass
  mix.sass(['app.scss'], 'public/compiled/css');

  // jQuery
  mix.copy('node_modules/jquery/dist', 'public/compiled/js/jquery');

  // jQuery SlimScroll
  mix.copy('node_modules/jquery-slimscroll/jquery.slimscroll.min.js', 'public/compiled/js/jquery-slimscroll/jquery.slimscroll.min.js');

  // Bootstrap
  mix.copy('node_modules/bootstrap/dist', 'public/compiled/css/bootstrap');

  // Vue
  mix.copy('node_modules/vue/dist', 'public/compiled/js/vue');

  // FastClick
  mix.copy('node_modules/fastclick/lib/fastclick.js', 'public/compiled/js/fastclick/fastclick.js');

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
  mix.copy('node_modules/bootstrap-material-datetimepicker', 'public/compiled/js/bootstrap-material-datetimepicker');

  // modernizr
  mix.copy('modernizr-config.json', 'public/compiled/js/modernizr/modernizr-config.json');
  mix.task('modernizr');

  // datatables
  mix.copy('node_modules/datatables.net-bs', 'public/compiled/vendors/datatables');
  mix.copy('node_modules/datatables.net/js', 'public/compiled/vendors/datatables/js');

  // Font-awesome
  mix.copy('node_modules/font-awesome', 'public/compiled/vendors/font-awesome');

  // Select2
  mix.copy('node_modules/select2/dist', 'public/compiled/vendors/select2');
  mix.copy('node_modules/select2-bootstrap-theme/dist', 'public/compiled/vendors/select2/css/');

  // Datetimepicker
  mix.copy('node_modules/datetimepicker/build', 'public/compiled/vendors/datetimepicker');

  // Routes from laravel to javascript
  // mix.routes();

  // Webpack
  mix.webpack('app.js');

  // version
  mix.version(['compiled/css/app.css', 'js/app.js', 'js/laroute.js']);

});
