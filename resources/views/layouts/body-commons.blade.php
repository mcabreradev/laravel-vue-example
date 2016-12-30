<!-- jQuery -->
<script src="{{ asset('/compiled/js/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap (also on head-commons) -->
<script src="{{ asset('/compiled/css/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- jQuery SlimScroll -->
<script src="{{ asset('/compiled/js/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- jQuery Datatables -->
<script src="{{ asset('/compiled/vendors/datatables/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/compiled/vendors/datatables/js/dataTables.bootstrap.js') }}"></script>

<!-- FastClick -->
<script src="{{ asset('/compiled/js/fastclick/fastclick.js') }}"></script>

<!-- theme -->
<!-- Optionally, you can add Slimscroll and FastClick plugins.
   Both of these plugins are recommended to enhance the
   user experience. Slimscroll is required when using the
   fixed layout. -->
<script>
  (function(){
    'use strict';

    window.AdminLTEOptions = {
      enableFastclick: true
    };
  })();
</script>
<script src="{{ asset('/compiled/js/admin-lte/app.min.js') }}"></script>

<!-- SweetAlert (also in head-commons) -->
<script src="{{ asset('/compiled/js/sweetalert/sweetalert.min.js') }}"></script>

<!-- Select2 (also in head-commons) -->
<script src="{{ asset('/compiled/vendors/select2/js/select2.min.js') }}"></script>

<!-- momentJs -->
<script src="{{ asset('/compiled/js/momentjs/moment-with-locales.min.js') }}"></script>

<!-- bootstrap-material-datetimepicker -->
<script src="{{ asset('/compiled/js/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>

<script>
    window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?>
</script>

<script src="{{ asset('js/app.js') }}"></script>

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
<script>
  (function($){
    $('.select2').select2({
      language: 'es',
      placeholder: 'Seleccione',
    });
      // Hack para que tome el 100% de width
    $('.select2, span.select2, li.select2-search, input.select2-search__field').css('width', '100%');
  })(window.jQuery);
</script>
