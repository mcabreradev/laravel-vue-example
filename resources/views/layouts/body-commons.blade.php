<!-- routes de laravel en js -->
<script>
    window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(), 'baseUrl' => url('/') ]); ?>
</script>
<script src="{{ asset(elixir('js/laroute.js')) }}"></script>

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

<script src="{{ asset('/compiled/vendors/text-mask/vanilla/vanillaTextMask.js') }}"></script>
<script src="{{ asset('/compiled/vendors/text-mask/addons/textMaskAddons.js') }}"></script>

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

<!-- datetimepicker -->
<script src="{{ asset('/compiled/vendors/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
<script>$.datetimepicker.setLocale('es');</script>

<script src="{{ asset(elixir('js/app.js')) }}"></script>

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
      theme: 'bootstrap'
    });
  })(window.jQuery);
</script>

@if( (! auth()->user()) || (!auth()->user()->roles()->count()) )
  <!-- Userlike (chat) -->
  <script async type=text/javascript src=//userlike-cdn-widgets.s3-eu-west-1.amazonaws.com/76555724277d3c13f29f3e3fdf384a3a8b14d908b8874a4f1638e341632f6872.js></script>
@endif

