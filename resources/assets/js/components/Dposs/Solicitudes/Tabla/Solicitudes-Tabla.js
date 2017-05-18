/**
 *
 */
export default {
  name: 'dposs-tabla-solicitudes',

  props: {
    title: {
      type: String,
      default: () => {},
      required: false
    },
    fields: {
      type: Array,
      default: () => {
        return []
      },
      required: true
    },
    showTfoot: {
      type: Boolean,
      default: false
    },
    hasModal: {
      type: Boolean,
      default: false,
      required: false
    },
    model: {
      type: Object,
      default: function () {
        return {
          singular: '',
          plural: ''
        };
      },
    },
    estado: {
      type: Number,
      required: true
    }
  },

  /**
   *  Inicializacion de variables internas
   **/
  data: function () {
    var self = this;

    return {
      PanalConf: PanalConf,
      rows: [],
      derivaciones_data: {},
      seguimientos_data: {},
      solicitud_id: null,
      solicitud_relacionados: [],
      solicitudes: [],
      areas: [],
      agentes: [],
      modal: {
        type: PanalConf.lang.button.create,
        action: 'create'
      },
      route: {
        create: Laravel.baseUrl + '/' + laroute.route('solicitudes::solicitudes.create'),
        imprimir: (id) => Laravel.baseUrl + '/' + laroute.route('solicitudes::solicitudes.imprimir', {id: id}),
        ordenTrabajo: (id) => Laravel.baseUrl + '/' + laroute.route('solicitudes::solicitudes.orden-trabajo', {id: id}),
        edit: (id) => Laravel.baseUrl + '/' + laroute.route('solicitudes::solicitudes.edit', {id: id}),
        timeline: (id) => Laravel.baseUrl + '/' + laroute.route('solicitudes::solicitudes.timeline', {id: id})
      },
      tableId: 'table-id-' + _.random(9999999, 99999999),
      modalId: 'modal-id-' + _.random(9999999, 99999999),
    }
  },

  mounted() {
    Events.$emit('indicator.show');
    var self = this;
    self.checkEvents()
      .findAll()
      .makeDomFixes()
      .derivacionesPrepared();
  },

  methods: {

    /**
     *  Funcion para que checkar eventos, se tiggerea desde el metodo mount()
     **/
    checkEvents: function () {
      var self = this;

      // Aqui se listaran los listeners de eventos
      Events.$on('datetimepicker.change', (value) => {
        self.derivaciones_data.derivado_el = value;
        self.seguimientos_data.generado_el = value;
      });

      return self;
    },

    /**
     *  Utilidad para calendario.
     *
     *  Funciona de dos maneras
     *  1- Detecta si en los fields existe el campo "calendar"
     *  2- Obtiene el nombre del campo "calendar"
     *
     **/
    getCalendarFieldName: function () {
      var field = _.find(this.fields, {
        type: 'calendar'
      });

      if (!_.isUndefined(field)) {
        return field.name;
      }
      return false;
    },

    /**
     *  Trae la lista de data a mostrar en la tabla
     **/
    findAll: function () {
      var self = this,
          route = Laravel.baseUrl + '/' + laroute.route('solicitudes::index') +
                  '?estado=' + self.estado;
      self.$http.get(route).then((res) => {
        if (res.ok) {
          self.rows = res.body.data;
        }
        self.startDataTable();
        Events.$emit('indicator.hide');
      });

      return this;
    },

    /**
     *  Inicia el plugin para la DataTable
     **/
    startDataTable: function () {
      var self = this;
      setTimeout(function () {
        self.table = $('#' + self.tableId).DataTable({
          "lengthMenu": [ 25, 50, 100, 200 ],
          "language": PanalConf.lang.datatable,
          "order": [[ 0, "desc" ]],
          "aoColumnDefs": [{
            'bSortable': false,
            'aTargets': [-1]
          }],
        });
      }, 50);

      return this;
    },

    /**
     *  Destruye la tabla y la vuelve a cargar
     **/
    reloadDataTable: function () {
      var self = this;
      $('#' + self.tableId).DataTable({
        destroy: true
      }).destroy();
      self.findAll();

      return this;
    },

    /**
     *  Hace algunos fixes necesarios
     **/
    makeDomFixes: function () {
      var self = this;
      setTimeout(function () {
        window.$('#' + self.tableId + '_length, #' + self.tableId + '_filter').parent().addClass('col-xs-6')
        window.$('#' + self.tableId + '_wrapper').addClass('mt-20 ');
      }, '2000');

      return this;
    },

    /**
     * Abre o cierra el modal
     */
    toggleDerivacionModal: () => {
      $('.derivaciones').modal('toggle');
      return this;
    },

    /**
     * Funcion que prepara las derivaciones, las llamadas a las api y asignacion de variables
     */
    derivacionesPrepared: function () {
      var self = this,
          routeAreas = Laravel.baseUrl + '/' + laroute.route('solicitudes::areas'),
          routeAgentes = Laravel.baseUrl + '/' + laroute.route('solicitudes::agentes');

      this.$http.get(routeAreas).then((res) => {
        this.areas = res.body.data;
      });

      this.$http.get(routeAgentes).then((res) => {
        this.agentes = res.body.data;
      });

      return this;
    },

    /**
     * Los campos del formulario limpios con valor null
     */
    clearDerivacionesDataFields: function () {
      return {
        derivacion_id: null,
        observaciones: null,
        solicitud_id: this.solicitud_id,
        relacionados: [],
        derivado_el: null,
        agente_id: null,
        area_id: null,
      };
    },

    /**
     * Funcion que limpia los campos del formulario
     */
    clearDerivacionesData: function () {
      var self = this;
      self.derivaciones_data = self.clearDerivacionesDataFields();

      return this;
    },

    /**
     * Cuando se hace click en el icono de
     */
    onClickDerivacion: function (solicitud) {
      var self = this;
      // Seteo la solicitud para tenerla en variable asi se puede guardar
      self.solicitud_id = solicitud.id;
      // me guardo los reclamos relacionados
      self.solicitud_relacionados = solicitud.relacionados;

      // Abro el modal
      self.toggleDerivacionModal();
      self.clearDerivacionesData();

      return self;
    },

    /**
     *  Es la funcion que se llama al hacer submit en el formulario
     *  bien podria ser update, pero por se un caso 'custom' es solo store
     */
    derivacionesSubmit: function () {
      var self  = this,
          route = Laravel.baseUrl + '/' + laroute.route('solicitudes::derivaciones.store');

      Events.$emit('indicator.show');
      self.toggleDerivacionModal();
      self.$http.post(route, self.derivaciones_data).then((res) => {
        self.reloadDataTable();
      }, (err) => {
        Events.$emit('indicator.hide');
        console.error('Error: ', err);
      });

      return self;
    },

    /**
     * Abre o cierra el modal
     */
    toggleSeguimientosModal: () => {
      $('.seguimientos').modal('toggle');
      return this;
    },

    /**
     * Los campos del formulario limpios con valor null
     */
    clearSeguimimentosDataFields: function () {
      return {
        solicitud_id: this.solicitud_id,
        generado_el: null,
        descripcion: null,
        relacionados: []
      };
    },

    /**
     * Cuando se hace click en el icono de
     */
    onClickSeguimiento: function (solicitud) {
      var self = this;
      self.solicitud_id = solicitud.id;
      self.solicitud_relacionados = solicitud.relacionados;

      self.toggleSeguimientosModal();
      self.seguimientos_data = self.clearSeguimimentosDataFields();

      return self;
    },

    /**
     *
     */
    seguimientosSubmit: function () {
      var self  = this,
          route = Laravel.baseUrl + '/' + laroute.route('solicitudes::seguimientos.store');

      Events.$emit('indicator.show');
      self.toggleSeguimientosModal();

      self.$http.post(route, self.seguimientos_data).then((res) => {
        self.reloadDataTable();
      }, (err) => {
        Events.$emit('indicator.hide');
        console.error('Error: ', err);
      });

      return self;
    },
  }
}
