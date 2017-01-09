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
Vue.component('panal-table', require('./table.vue'));
