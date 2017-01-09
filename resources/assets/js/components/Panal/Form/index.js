/**
*  Panal module
*
*  Register every component for be loaded as a hole module!
*
*/

/**
 *  Panal Form
 *
 *  @fields  Array    the list of fields for build the form
 *  @form    Object   list of variables required by the form
 *
 *  <panal-form
 *    :fields="fields"
 *    :form="form">
 *  </panal-form>
 */
Vue.component('panal-form', require('./form.vue'));

Vue.component('panal-form-2', require('./form.2.vue'));
