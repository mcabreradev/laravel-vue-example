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
          <a class="btn btn-primary pull pull-right" v-if="hasModal" v-on:click="openCreateModal" name="btnadd" id="modalBtn">
            <i class="fa fa-plus"></i> {{ PanalConf.lang.button.create }} <span class="text-capital">{{ model.singular }}</span>
          </a>
          <a :href="route.create" class="btn btn-primary pull pull-right" v-else name="btnadd">
            <i class="fa fa-plus"></i> {{ PanalConf.lang.button.create }} <span class="text-capital">{{ model.singular }}</span>
          </a>
        </div>
      </div>
      <div class="row">
        <!-- Table container -->
        <div class="col-md-12 col-sm-12 col-xs-12 table-container">
          <div class="table-responsive">
            <table :id="tableId" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th v-for="field in fields" v-if="field.type !='hidden'">{{ field.title }}</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tfoot v-if="showTfoot">
                <tr>
                  <th v-for="field in fields" v-if="field.type !='hidden'">{{ field.title }}</th>
                  <th>Acciones</th>
                </tr>
              </tfoot>
              <tbody>
                <tr v-for="row in rows">
                  <td v-for="field in fields" v-if="field.type !='hidden'">
                    <div v-if="field.name === 'color'" role="button" v-bind:style="{'background-color': row[field.name]}" class="color-square"
                      v-on:click="openUpdateModal(row.id)">
                    </div>
                    <div v-if="field.type === 'datetime'">
                      <panal-tooltip :title="row[field.name] | datetimeToHuman">
                        {{ row[field.name] | date }}
                      </panal-tooltip>
                    </div>
                    <div v-else>{{ row[field.name] }}</div>
                  </td>
                  <td>
                    <div>
                      <a role="button" class='btn btn-primary btn-sm' v-if="hasModal" v-on:click="openUpdateModal(row.id)">
                        <span class="fa fa-pencil"></span>
                      </a>
                      <a :href="route.edit(row.id)" class="btn btn-primary btn-sm" v-else>
                        <span class="fa fa-pencil"></span>
                      </a>
                      <a role="button" class="btn btn-danger btn-sm" v-on:click="destroy(row.id)">
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

    <!-- main modal -->
    <div class="modal fade" tabindex="-1" role="dialog" :id="modalId">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">{{ modal.type }} <span class="text-capital">{{ model.singular }}</span></h4>
          </div>
          <form class="form-horizontal" v-on:submit.prevent="submit(modal.action)">
            <div class="modal-body smart-modal-form">
              <div class="messages"></div>
              <!--Loop de columnas-->
              <div class="form-group" v-for="field in fields" :key="field.id">
                <label class="col-sm-2 control-label" v-bind:for="field">{{ field.title }}</label>
                <div class="col-sm-10">
                  <panal-inputs :field="field" :data="data"></panal-inputs>
                </div>
              </div>
              <!--Fin Loop de columnas-->
            </div>
            <div class="modal-footer">
              <a type="button" class="btn btn-default" data-dismiss="modal">{{ PanalConf.lang.button.cancel }}</a>
              <button type="submit" class="btn btn-primary">{{ modal.type }}</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /main modal -->

  </div>
</template>
<script>
  export default {
    name: 'panal-table',

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
        required: true
      },
      showTfoot: {
        type: Boolean,
        default: false
      },
      hasModal: {
        type: Boolean,
        default: true,
        required: false
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
        data: {},
        data_model: {plural: _.deburr(self.model.plural), singular: _.deburr(self.model.singular)},
        modal: {type: PanalConf.lang.button.create, action: 'create'},
        route: self.hasModal ? {} : {
          create: Router.route(self.url.doble + '.create'),
          edit: function (id) {
            return Router.route(self.url.doble + '.edit', {
              id: id
            })
          },
        },
        apiRoute: _.join([API, self.url.simple, ''], '.'),
        tableId: 'table-id-' + _.random(9999999, 99999999),
        table : null,
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

        // Aqui se listaran los listeners de eventos
        Events.$on('datetimepicker.change', (value) => {
          self.$data.data[self.getDatetimeFieldName()] = value;
        });

        return self;
      },

      /**
       *  Utilidad para datetime.
       *
       *  Funciona de dos maneras
       *  1- Detecta si en los fields existe el campo "datetime"
       *  2- Obtiene el nombre del campo "datetime"
       *
       **/
      getDatetimeFieldName: function () {
        var field = _.find(this.fields, {
          type: 'datetime'
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
       **/
      toggleModal: function () {
        $('#' + this.modalId ).modal('toggle');
        return this;
      },

      /**
       *  Trae la lista de data a mostrar en la tabla
       **/
      findAll: function () {
        var self = this;

        // Default query route for index
        var route = Router.route(self.apiRoute + 'index');

        // query with conditions
        if (self.where) {
          route = Router.route(self.apiRoute + 'show', {
            [self.data_model.plural]: self.where.id
          });
        }

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

        return self;
      },

      /**
       *  Destruye la tabla y la vuelve a cargar
       **/
      reloadDataTable: function () {
        var self = this;
        self.table.destroy();
        this.findAll();

        return this;
      },

      /**
       *  Hace algunos fixes necesarios
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
       **/
      submit: function (type) {
        (type == 'create') ? this.create(): this.update();
      },

      /**
       *  Funcion que se carga al abrir un modal create, prepara la data para ser guardada
       **/
      openCreateModal: function () {
        var self = this;
        self.setObjectsFromFormFields();
        self.toggleModal();
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
        self.data = _.find(self.rows, {'id': id}); // Find the current data in the row array, and load the modal input
        self.modal = {
          type: 'Editar',
          action: 'update'
        };
        self.toggleModal();

         // Si hay un campo calendario, emitir evento para que lo reciba el calendario
        if (self.getDatetimeFieldName()) {
          Events.$emit('calendar.value.fromParent', self.data[self.getDatetimeFieldName()]);
        }
      },

      /**
       *  Guarda la data, este evento envia la data post a la api
       **/
      create: function () {
        var self = this;
        Events.$emit('indicator.show');
        self.toggleModal();

        self.$http.post(Router.route(self.apiRoute + 'store'), self.data)
          .then((res) => {
              self.reloadDataTable();
              Events.$emit('indicator.hide');
            },
            (err) => {
              console.error('Error:: ', err);
              self.toggleModal();
            });
      },

      /**
       *  Actualizacion de la data
       **/
      update: function () {
        var self = this;
        Events.$emit('indicator.show');
        self.toggleModal();

        self.$http.put(Router.route(self.apiRoute + 'update', {
            [self.data_model.plural]: self.data.id
          }), self.data)
          .then((res) => {
              self.reloadDataTable();
              Events.$emit('indicator.hide');
            },
            (err) => {
              console.error('Error:: ', err);
              self.toggleModal();
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
          () => {
            Events.$emit('indicator.show');
            self.$http.delete(Router.route(self.apiRoute + 'destroy', {
              [self.data_model.plural]: id
            })).then((res) => {
              res.json().then((data) => {
                if (data.hasOwnProperty('error')) {
                  swal({
                    type:'error',
                    title: data.error.message
                  });
                }
                else {
                  self.rows = _.reject(self.rows, {
                    'id': id
                  });
                  self.reloadDataTable();
                }
                Events.$emit('indicator.hide');
              });
            });
          });
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
