/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Filtros utiles
 */
Vue.filter('dateOnly', function (value) {
  return moment(value).format('DD/MM/Y');
});

Vue.filter('hourSecondsOnly', function (value) {
  return moment(value, 'HH:mm:ss').format('HH:mm');
});


/**
 * Lista de Componentes
 */
require('./components/Panal/index.js')

Vue.component('turnos-table', require('./components/turnos/TurnosTable.vue'));

const app = new Vue({
  el: '#app'
});
