
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
Vue.component('panal-box', require('./box.vue'));

Vue.component('panal-box-slot', require('./box-slot.vue'));
