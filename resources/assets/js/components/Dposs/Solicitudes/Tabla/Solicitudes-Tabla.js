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
    url: {
      type: Object,
      default: () => {
        return {}
      },
      required: true
    },
    estadoCerrado: {
      type: Boolean,
      default: () => false,
      required: false
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
      solicitudes_data: {},
      derivaciones_data: {},
      seguimientos_data: {},
      solicitud_id: null,
      solicitudes: [],
      areas: [],
      agentes: [],
      modal: {
        type: PanalConf.lang.button.create,
        action: 'create'
      },
      route: self.hasModal ? {} : {
        create: Router.route(self.url.doble + '.create'),
        imprimir: (id) => Router.route(self.url.doble + '.imprimir', {
          id: id
        }),
        edit: function (id) {
          return Router.route(self.url.doble + '.edit', {
            id: id
          })
        },
        timeline: function (id) {
          return Router.route(self.url.doble + '.timeline', {
            id: id
          })
        },
      },
      apiRoute: _.join([API, self.url.simple, ''], '.'),
      tableId: 'table-id-' + _.random(9999999, 99999999),
      modalId: 'modal-id-' + _.random(9999999, 99999999),
    }
  },

  mounted() {
    Events.$emit('indicator.show');
    var self = this;
    self.checkEvents()
      .setObjectsFromFormFields()
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
     *  Crea un objeto vacio "this.solicitudes_data" con todos los nombres de los fields
     *  para que funcione el data-binding en los formularios para v-model,
     *  una vez creados se cambia el valor desde el formulario
     *
     **/
    setObjectsFromFormFields: function () {
      _.each(this.fields, (val) => {
        this.solicitudes_data[val.name] = '';
        if (val.type == 'hidden') {
          this.solicitudes_data[val.name] = val.value;
        }

      });

      return this;
    },

    /**
     *  Trae la lista de data a mostrar en la tabla
     **/
    findAll: function () {
      var self = this;
      self.$http.get(Router.route(self.apiRoute + 'index') + '?cerrado=' + self.estadoCerrado).then((res) => {
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
          "language": PanalConf.lang.datatable,
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
     *  Funcion que es llamada cuando se hace click en el boton
     **/
    submit: function (type) {
      var self = this;
      (type == 'create') ? self.create(): self.update();
    },

    /**
     *  Funcion que se carga al abrir un modal create, prepara la data para ser guardada
     **/
    openCreateModal: function () {
      var self = this;
      self.setObjectsFromFormFields();
      self.modal = {
        type: 'Agregar',
        action: 'create'
      };
    },

    /**
     *  Funcion que se carga al abrir un modal update, prepara la data para ser actulizada
     **/
    openUpdateModal: function (id) {
      var self = this;
      self.solicitudes_data = _.find(self.rows, {
        'id': id
      }); // Find the current data in the row array, and load the modal input
      self.modal = {
        type: 'Editar',
        action: 'update'
      };

      // Si hay un campo calendario, emitir evento para que lo reciba el calendario
      if (self.getCalendarFieldName()) {
        Events.$emit('calendar.value.fromParent', self.solicitudes_data[self.getCalendarFieldName()]);
      }
    },

    /**
     *  Guarda la data, este evento envia la data post a la api
     **/
    create: function () {
      var self = this;
      Events.$emit('indicator.show');

      console.log(self.solicitudes_data);
      return;

      $('#modal').modal('toggle');


      self.$http.post(Router.route(self.apiRoute + 'store'), self.solicitudes_data).then((res) => {
        self.reloadDataTable();
        Events.$emit('indicator.hide');

      }, (err) => {
        console.error('Error: ', err);
      });
    },

    /**
     *  Actualizacion de la data
     **/
    update: function () {
      var self = this;
      Events.$emit('indicator.show');

      self.$http.put(Router.route(self.apiRoute + 'update', {
        [self.model.plural]: self.solicitudes_data.id
      }), self.solicitudes_data).then((res) => {
          self.reloadDataTable();
          Events.$emit('indicator.hide');
          $('#modal').modal('toggle');
        },
        (err) => {
          console.error('Error:: ', err);
        });
    },

    /**
     *  Borrado de data
     **/
    destroy: function (id) {
      var self = this;

      swal({
          title: "Estás seguro/a?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Si, borrar",
          closeOnConfirm: true
        },
        function () {
          Events.$emit('indicator.show');
          self.$http.delete(Router.route(self.apiRoute + 'destroy', {
            [self.model.plural]: id
          })).then((res) => {
            self.rows = _.reject(self.rows, {
              'id': id
            });
            self.reloadDataTable();
            Events.$emit('indicator.hide');
          });

        });
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
      var self = this;

      this.$http.get(Router.route(API + '.solicitudes.derivaciones.index')).then((res) => {
        this.derivaciones = res.body.data;
      });

      this.$http.get(Router.route(API + '.solicitudes.areas.index')).then((res) => {
        this.areas = res.body.data;
      });

      this.$http.get(Router.route(API + '.solicitudes.agentes.index')).then((res) => {
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
        solicitud_id: this.$data.solicitud_id,
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
      self.$data.derivaciones_data = self.clearDerivacionesDataFields();

      return this;
    },

    /**
     * Cuando se hace click en el icono de
     */
    onClickDerivacion: function (solicitud_id, derivacion_id) {
      var self = this;
      // Seteo la solicitud para tenerla en variable asi se puede guardar
      self.solicitud_id = solicitud_id;
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
      var self = this;
      Events.$emit('indicator.show');
      self.toggleDerivacionModal();
      self.$http.post(Router.route(API + '.solicitudes.derivaciones.store'), self.derivaciones_data).then((res) => {
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
        solicitud_id: this.$data.solicitud_id,
        generado_el: null,
        descripcion: null,
      };
    },

    /**
     * Cuando se hace click en el icono de
     */
    onClickSeguimiento: function (solicitud_id) {
      var self = this;
      self.solicitud_id = solicitud_id;
      self.toggleSeguimientosModal();
      self.$data.seguimientos_data = self.clearSeguimimentosDataFields();

      return self;
    },

    /**
     *
     */
    seguimientosSubmit: function () {
      var self = this;
      Events.$emit('indicator.show');
      self.toggleSeguimientosModal();
      self.$http.post(Router.route(API + '.solicitudes.seguimientos.store'), self.seguimientos_data).then((res) => {
        self.reloadDataTable();
      }, (err) => {
        Events.$emit('indicator.hide');
        console.error('Error: ', err);
      });

      return self;
    },
  }
}
