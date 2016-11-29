/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Lista de Componentes
 */

Vue.component('smart-table', require('./components/Smart/Table/SmartTable.vue'));

const app = new Vue({
  el: '#app'
});
