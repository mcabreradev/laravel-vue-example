export default {
  name: 'dposs-derivaciones-tabla',

  /**
   *  Variables que se utlizan como entrada
   **/
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
      required: false
    },
    showTfoot: {
      type: Boolean,
      default: false
    },
    where: {
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
    params: {
      type: Object,
      default: () => {
        return {}
      },
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
      data: {
        id:            null,
        solicitud_id:  null,
        derivado_el:   null,
        agente_id:     null,
        area_id:       null,
        observaciones: null
      },
      areas: [],
      agentes: [],
      modal: {
        type: PanalConf.lang.button.create,
        action: 'create'
      },
      tableId: 'table-id-' + _.random(9999999, 99999999),
      modalId: 'modal-id-' + _.random(9999999, 99999999),
    }
  },

  /**
   *  Cuando el componente esta listo y montado
   **/
  mounted() {
    Events.$emit('indicator.show');
    var self = this;
    this.checkEvents()
      .setObjectsFromFormFields()
      .findAll()
      .findAllOptions()
      .makeDomFixes();
  },

  /**
   *  Metodos del componente
   **/
  methods: {

    /**
     *  Funcion para que checkar eventos, se tiggerea desde el metodo mount()
     **/
    checkEvents: function () {
      var self = this;

      Events.$on('datetimepicker.change', (value) =>{
        self.data.derivado_el = value;
      });

      Events.$on('derivaciones.modals.create.open', () => {self.openCreateModal()});

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
     *  Crea un objeto vacio "this.data" con todos los nombres de los fields
     *  para que funcione el data-binding en los formularios para v-model,
     *  una vez creados se cambia el valor desde el formulario
     *
     **/
    setObjectsFromFormFields: function () {
      _.each(this.fields, (val) => {
        this.data[val.name] = '';
        if (val.type == 'hidden') {
          this.data[val.name] = val.value;
        }
      });
      return this;
    },

    /**
     *  Muestra y oculta el modal
     *
     **/
    toggleModal: function () {
      $('#' + this.modalId).modal('toggle');
      return this;
    },

    /**
     *  Se trae del api la lista de opciones que alimentaran los selects del modal
     *
     */
    findAllOptions: function () {
      var routeAreas   = Laravel.baseUrl + '/' + laroute.route('solicitudes::areas'),
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
     *  Trae la lista de data a mostrar en la tabla
     *
     **/
    findAll: function () {
      var self = this;

      // Default query route for index
      var route = Laravel.baseUrl + '/' +
        laroute.route('solicitudes::derivaciones.por-solicitud', {solicitudId: self.data.solicitud_id});

      self.$http.get(route).then((res) => {
          if (res.ok) {
            self.rows = res.body.data;
          }
          self.startDataTable();
          Events.$emit('indicator.hide');
        },
        (err) => {
          console.error('Error:: ', err);
        });

      return self;
    },

    /**
     *  Inicia el plugin para la DataTable
     *
     **/
    startDataTable: function () {
      var self = this;
      setTimeout(function () {
        self.table = $('#' + self.tableId).DataTable({
          "language": self.PanalConf.lang.datatable,
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
     *
     **/
    reloadDataTable: function () {
      var self = this;
      $('#' + self.tableId).DataTable({
        destroy: true
      }).destroy();
      this.findAll();

      return this;
    },

    /**
     *  Hace algunos fixes necesarios
     *
     **/
    makeDomFixes: function () {
      var self = this;
      setTimeout(function () {
        window.$('#' + self.tableId + '_length, #'+ self.tableId + '_filter').parent().addClass('col-xs-6')
        window.$('#' + self.tableId + '_wrapper').addClass('mt-20 ');
      }, '2000');

      return this;
    },

    /**
     *  Funcion que es llamada cuando se hace click en el boton
     *
     **/
    submit: function (type) {
      (type == 'create') ? this.create(): this.update();
    },

    /**
     *  Funcion que se carga al abrir un modal create, prepara la data para ser guardada
     *
     **/
    openCreateModal: function () {
      var self = this;
      self.cleanData();
      self.modal = {
        type: 'Agregar',
        action: 'create'
      };

      self.toggleModal();
    },

    /**
     *  Guarda la data, este evento envia la data post a la api
     *
     **/
    create: function () {
      var self  = this,
          route = Laravel.baseUrl + '/' + laroute.route('solicitudes::derivaciones.store');

      Events.$emit('indicator.show');
      self.toggleModal();

      self.$http.post(route, self.data)
        .then((res) => {
            self.reloadDataTable();
            Events.$emit('indicator.hide');
          },
          (err) => {
            // self.toggleModal();
            Events.$emit('indicator.hide');
            $('.content-header').html(err.body);
            console.error('Error:: ', err.body);
        });
    },

    /**
     *  Funcion que se carga al abrir un modal update, prepara la data para ser actulizada
     *
     **/
    openUpdateModal: function (id) {
      var self = this;
      self.cleanData();
      self.data = _.find(self.rows, { 'id': id });
      self.modal = {
        type: 'Editar',
        action: 'update'
      };
      self.toggleModal();
      // Si hay un campo calendario, emitir evento para que lo reciba el calendario
      if (self.getCalendarFieldName()) {
        Events.$emit('calendar.value.fromParent', self.data[self.getCalendarFieldName()]);
      }
    },

    /**
     *  Actualizacion de la data
     *
     **/
    update: function () {
      var self  = this,
          route = Laravel.baseUrl + '/' + laroute.route('solicitudes::derivaciones.update', {id:self.data.id});

      Events.$emit('indicator.show');

      self.$http.put(route, self.data)
        .then((res) => {
          self.toggleModal();
          self.reloadDataTable();
          Events.$emit('indicator.hide');

          },
          (err) => {
            console.error('Error:: ', err);
            Events.$emit('indicator.hide');
            self.toggleModal();
          });
    },

    /**
     *  Borrado de data
     *
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
        () => {
          var route = Laravel.baseUrl + '/' + laroute.route('solicitudes::derivaciones.destroy', {id:id});

          Events.$emit('indicator.show');

          self.$http.delete(route).then((res) => {
            self.rows = _.reject(self.rows, {
              'id': id
            });
            self.reloadDataTable();
            Events.$emit('indicator.hide');
          });
        });
    },

    /**
     * Limpia las variables, como son reactivas tengo que vaciar su contenido para reutilizarlas
     *
     */
    cleanData: function () {
      var self = this;
      self.$data.data = {
        id:            null,
        solicitud_id:  self.data.solicitud_id,
        derivado_el:   null,
        agente_id:     null,
        area_id:       null,
        observaciones: null
      };
    },

    /**
     *  Retorna nombre completo del agente si existe
     */
    getAgenteName: function (agente) {
      return _.isNull(agente) ? null : agente.apellido + ', '+ agente.nombre;
    },

    /**
     * Retorna el nombre del area si existe
     */
    getAreaName: function(area){
      return _.isNull(area) ? null : area.nombre;
    }
  },
}
