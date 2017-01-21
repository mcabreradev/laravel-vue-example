/**
 * Filtros utiles
 */
Vue.filter('dateOnly', function (value) {
  return _.isNull(value) ? value : moment(value).format('DD/MM/Y');
});

Vue.filter('hourSecondsOnly', function (value) {
  return _.isNull(value) ? value : moment(value).format('HH:mm');
});

Vue.filter('datetimeFromNow', function (value) {
  return _.isNull(value) ? value : moment(value).fromNow();
});

Vue.filter('datetimeToHuman', function (value) {
  return _.isNull(value) ? value : moment(value).format('LLLL');
});

Vue.filter('date', function (value) {
  return _.isNull(value) ? value : moment(value).format('DD/MM/Y HH:mm');
});
