<!-- jQuery -->
<script src="{{ asset('compiled/js/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap (also on head-commons) -->
<script src="{{ asset('compiled/css/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- theme -->
<!-- Optionally, you can add Slimscroll and FastClick plugins.
   Both of these plugins are recommended to enhance the
   user experience. Slimscroll is required when using the
   fixed layout. -->
<script src="{{ asset('compiled/js/admin-lte/app.min.js') }}"></script>

<!-- SweetAlert (also in head-commons) -->
<script src="{{ asset('compiled/js/sweetalert/sweetalert.min.js') }}"></script>

<!-- momentJs -->
<script src="{{ asset('compiled/js/momentjs/moment-with-locales.min.js') }}"></script>

<!-- bootstrap-material-datetimepicker -->
<script src="{{ asset('compiled/js/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>

<!-- Date, time and datetieme polyfills -->
<script>
  (function($, Modernizr) {
    if (!Modernizr.inputtypes.date) {
      $('input[type=date]').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD',
        time: false,
        lang: 'es'
      });
    }

    if (!Modernizr.inputtypes.time) {
      $('input[type=time]').bootstrapMaterialDatePicker({
        format: 'HH:mm',
        date: false,
        lang: 'es'
      });
    }

    if (!Modernizr.inputtypes.datetime) {
      $('input[type=datetime]').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD HH:mm:00',
        lang: 'es'
      });
    }

  })(window.jQuery, window.Modernizr);
</script>
