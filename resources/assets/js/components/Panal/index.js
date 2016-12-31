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
Vue.component('panal-form', require('./Form/form.vue'));

Vue.component('panal-form-2', require('./Form/form.2.vue'));


/**
 *  Panal Box
 *
 *  @model   Object   the type of item in singular and plurar
 *  @url     Object   the two kind of posible route list with . and ::
 *  @type    String   type of form if is create or edir
 *  @item    Object   the item object retrieved from php
 *  @fields  Array    the list of field for build the form
 *
 *  <panal-box
 *     :model='{singular: "prioridad", plural: "prioridades"}'
 *     :url="{simple: 'solicitudes.prioridades', doble:'solicitudes::prioridades'}"
 *     :type="'edit'"
 *     :item="{{ $item }}" -> from php
 *     :fields="[
 *       {name: 'nombre', title: 'Nombre', type: 'text', required: true},
 *       {name: 'descripcion', title:'Descripción', type: 'textarea'},
 *       {name: 'color', title: 'Color', type: 'color'}
 *       ]">
 *   </panal-box>
 */
Vue.component('panal-box', require('./Box/box.vue'));

Vue.component('panal-box-slot', require('./Box/box-slot.vue'));


/**
 *  Panal Indicator
 *
 *  @is-active Bolean define the state, true or false
 *
 *  <panal-indicator :is-active="true"></panal-indicator>
 */
Vue.component('panal-indicator', require('./Indicator/indicator.vue'));


/**
 *  Panal Table
 *
 *  @model     Object   the type of item in singular and plurar
 *  @url       Object   the two kind of posible route list with . and ::
 *  @has-modal Bolean   if has modal or static content for add and edit
 *  @fields    Array    the list of field for build the form
 *
 *  <panal-table
 *     :model='{singular: "origen", plural: "origenes"}'
 *     :url="{simple: 'solicitudes.origenes', doble:'solicitudes::origenes'}"
 *     :has-modal="true"
 *     :fields="[
 *       {name: 'nombre', title: 'Nombre', type: 'text', required: true},
 *       {name: 'descripcion', title:'Descripción', type: 'textarea'},
 *       {name: 'color', title: 'Color', type: 'color'}
 *       ]">
 *   </panal-table>
 */
Vue.component('panal-table', require('./Table/table.vue'));


/**
 *  Panal Inputs
 *
 *  @field  Object   the list of fields for build the form
 *  @data   Object   list of variables required by the form
 *
 *  <panal-inputs :field="field" :data="data"></panal-inputs>
 */
Vue.component('panal-inputs', require('./Input/inputs.vue'));

// Vue.component('panal-map', require('./Map/map.vue'));


Vue.component('panal-calendar', require('./Calendar/calendar.vue'));


Vue.component('panal-modal', require('./Modal/modal.vue'));
