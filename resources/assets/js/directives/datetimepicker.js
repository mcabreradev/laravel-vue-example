Vue.directive('datetimepicker', {
  inserted: function (el) {
    $(el).bootstrapMaterialDatePicker({
      format: 'YYYY-MM-DD HH:mm:00',
      lang: 'es'
    }).on('change', function () {
      Events.$emit('datetimepicker.change', el.value);
    });
  },
});
