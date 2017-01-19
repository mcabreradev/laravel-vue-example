<template>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title" v-if="title">{{ title }}</h3>
      <h3 class="box-title" v-else>Lista de <span class="text-capital">{{ model.plural }}</span></h3>
    </div>
    <!--box-body-->
    <div class="box-body">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 mb-25">
          <a :href="route.create" class="btn btn-primary pull pull-right" name="btnadd">
            <i class="fa fa-plus"></i> {{ PanalConf.lang.button.create }} <span class="text-capital">{{ model.singular }}</span>
          </a>
        </div>
      </div>
      <div class="row">
        <!-- Table container -->
        <div class="col-md-12 col-sm-12 col-xs-12 table-container">
          <div class="table-responsive">
            <table id="smartTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Nro</th>
                  <th>Tipo</th>
                  <th>Ubicación</th>
                  <th>Última derivación
                  <th>Derivado a</th>
                  <th>Recibido por</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tfoot v-if="showTfoot">
                <tr>
                  <th>Fecha</th>
                  <th>Nro</th>
                  <th>Tipo</th>
                  <th>Ubicación</th>
                  <th>Última derivación
                  <th>Derivado a</th>
                  <th>Recibido por</th>
                  <th>Acciones</th>
                </tr>
              </tfoot>
              <tbody>
                <tr v-for="solicitud in rows">
                  <td role="button" :title="solicitud.creado_el | datetimeToHuman">{{ solicitud.creado_el | datetimeFromNow }}</td>
                  <td>{{ solicitud.id }}</td>
                  <td>{{ solicitud.tipo }}</td>
                  <td>{{ solicitud.lugar_calle }}</td>
                  <td role="button" :title="solicitud.derivacion.derivado_el | datetimeToHuman ">{{ solicitud.derivacion.derivado_el |date }}</td>
                  <td>{{ solicitud.derivacion.area }}</td>
                  <td>{{ solicitud.derivacion.agente }}</td>
                  <td>
                    <div>
                      <a role="button" class='btn btn-default btn-sm' data-toggle="tooltip" data-placement="top" title="Ver Timeline" :href="route.timeline(solicitud.id)">
                        <span class="fa fa-th-large"></span>
                      </a>
                      <a role="button" class='btn btn-default btn-sm' data-toggle="tooltip" data-placement="top" title="Derivar Solicitud" v-on:click="onClickDerivacion(solicitud.id, solicitud.derivacion.id)">
                        <span class="fa fa-repeat"></span>
                      </a>
                      <a role="button" class='btn btn-primary btn-sm' v-if="hasModal" v-on:click="openUpdateModal(solicitud.id)" data-toggle="modal" data-target="#modal">
                        <span class="fa fa-pencil"></span>
                      </a>
                      <a :href="route.edit(solicitud.id)" class="btn btn-primary btn-sm" v-else>
                        <span class="fa fa-pencil"></span>
                      </a>
                      <a role="button" class="btn btn-danger btn-sm" v-on:click="destroy(solicitud.id)">
                        <span class="fa fa-trash"></span>
                      </a>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!--End table container-->
      </div>
    </div>
    <!--end box-body-->
    <panal-indicator></panal-indicator>

    <!-- derivacions modal -->
    <div class="modal fade derivaciones" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Derivar Solicitud</h4>
          </div>
          <form class="form-horizontal" v-on:submit.prevent="derivacionesSubmit()">
            <div class="modal-body smart-modal-form">
              <div class="form-group">
                <label for="derivado_el" class="col-sm-2 control-label">Fecha</label>
                <div class="col-sm-10">
                  <panal-datetime name="derivado_el" :value="derivaciones_data.derivado_el"></panal-datetime>
                </div>
              </div>
              <div class="form-group">
                <label for="area_id" class="col-sm-2 control-label">Area</label>
                <div class="col-sm-10">
                  <select class="form-control" name="area_id" id="area_id" v-model="derivaciones_data.area_id" required>
                      <option value="">Seleccione</option>
                      <option v-for="area in areas" :value="area.id">{{ area.nombre }}</option>
                    </select>
                </div>
              </div>
              <div class="form-group">
                <label for="agente_id" class="col-sm-2 control-label">Agente</label>
                <div class="col-sm-10">
                  <select class="form-control" name="agente_id" id="agente_id" v-model="derivaciones_data.agente_id" required>
                      <option value="">Seleccione</option>
                      <option v-for="agente in agentes" :value="agente.id">{{ agente.nombre_completo }}</option>
                    </select>
                </div>
              </div>
              <div class="form-group">
                <label for="observaciones" class="col-sm-2 control-label">Observaciones</label>
                <div class="col-sm-10">
                  <textarea class="form-control" id="observaciones" name="observaciones" v-model="derivaciones_data.observaciones"></textarea>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <a type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /derivacions modal -->
  </div>
</template>
<script>

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
        solicitud_id: null,
        solicitudes: [],
        areas: [],
        agentes: [],
        modal: {type: PanalConf.lang.button.create, action: 'create'},
        route: self.hasModal ? {} : {
          create: Router.route(self.url.doble + '.create'),
          edit: function (id) {
            return Router.route(self.url.doble + '.edit', {id: id})
          },
          timeline: function(id){
            return Router.route(self.url.doble + '.timeline', {id:id})
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
        self.$http.get(Router.route(self.apiRoute + 'index')).then((res) => {
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
        setTimeout(function () {
          this.table = $('#smartTable').DataTable({
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
        $('#smartTable').DataTable({
          destroy: true
        }).destroy();
        self.findAll();

        return this;
      },

      /**
       *  Hace algunos fixes necesarios
       **/
      makeDomFixes: function () {
        setTimeout(function () {
          window.$('#smartTable_length, #smartTable_filter').parent().addClass('col-xs-6')
          window.$('#smartTable_wrapper').addClass('mt-20 ');
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
        self.solicitudes_data = _.find(self.rows, {'id': id}); // Find the current data in the row array, and load the modal input
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

        console.log(self.solicitudes_data); return;

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
      clearDerivacionesDataFields: function() {
        return {
          derivacion_id: null,
          observaciones: null,
          solicitud_id:  this.$data.solicitud_id,
          derivado_el:   null,
          agente_id:     null,
          area_id:       null,
        };
      },

      /**
       * Funcion que limpia los campos del formulario
       */
      clearDerivacionesData: function() {
        var self = this;
        self.derivaciones_data = self.clearDerivacionesDataFields();

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
        // Busco en el collection de derivaciones por solicitud y derivacion
        var q =  _.find(self.derivaciones, {'solicitud_id': solicitud_id, 'derivacion_id': derivacion_id});
        // si se encontro datos o no
        _.isUndefined(q) ? self.$data.derivaciones_data = self.clearDerivacionesDataFields() : self.$data.derivaciones_data = q;

        return self;
      },

      /**
       *  Es la funcion que se llama al hacer submit en el formulario
       *  bien podria ser update, pero por se un caso 'custom' es solo store
       */
      derivacionesSubmit: function () {
        var self = this;
        self.derivacionStore();

        return self;
      },

      /**
       *
       */
      derivacionStore: function () {
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
       *
       */
      derivacionUpdate: function () {
        var self = this;
        self.toggleDerivacionModal();

        Events.$emit('indicator.show');

        self.$http.put(Router.route(API + '.solicitudes.derivaciones.update', {
          'derivaciones': self.derivaciones_data.derivacion_id
        }), self.derivaciones_data).then((res) => {
          Events.$emit('indicator.hide');
        });

        return self;
      },
    }
  }

</script>
<style lang="sass" scoped>
  .color-square {
    height: 20px;
    width: 20px;
    border: 1px solid #9e9e9e;
  }

  .modal-header {
    border-bottom-color: #f4f4f4;
    background-color: #3c8dbc;
    color: #fff;
    margin-bottom: 10px;
  }

  .close {
    color: #fff;
    opacity: 0.7;
  }

  .close:hover {
    opacity: 0.9;
  }

</style>
