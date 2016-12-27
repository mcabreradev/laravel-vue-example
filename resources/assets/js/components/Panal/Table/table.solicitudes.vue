<template>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Lista de <span class="text-capital">{{ model.plural }}</span></h3>
    </div>
    <!--box-body-->
    <div class="box-body">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 mb-25">
          <button class="btn btn-primary pull pull-right" v-if="hasModal" v-on:click="createModal" name="btnadd" data-toggle="modal"
            data-target="#modal" id="modalBtn">
            <i class="fa fa-plus"></i> Agregar <span class="text-capital">{{ model.singular }}</span>
          </button>
          <a :href="route.create" class="btn btn-primary pull pull-right" v-else name="btnadd">
            <i class="fa fa-plus"></i> Agregar <span class="text-capital">{{ model.singular }}</span>
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
                  <th v-for="field in fields">{{ field.title }}</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tfoot v-if="showTfoot">
                <tr>
                  <th v-for="field in fields">{{ field.title }}</th>
                  <th>Acciones</th>
                </tr>
              </tfoot>
              <tbody>
                <tr v-for="row in rows">
                  <td v-for="field in fields">
                    <!-- si es un imput de color / colorpicker -->
                    <div v-if="field.name === 'color'" role="button" v-bind:style="{'background-color': row[field.name]}" class="color-square"
                      v-on:click="updateModal(row.id)" data-toggle="modal" data-target="#modal">
                    </div>
                    <div v-else>{{ row[field.name] }}</div>
                  </td>
                  <td>
                    <div>
                      <a role="button" class='btn btn-default btn-sm' v-on:click="onClickDerivacion(row.id)">
                        <span class="fa fa-repeat"></span>
                      </a>
                      <a role="button" class='btn btn-primary btn-sm' v-if="hasModal" v-on:click="updateModal(row.id)" data-toggle="modal" data-target="#modal">
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
    <div class="modal fade" tabindex="-1" role="dialog" id="modal">
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
                <label v-bind:for="field" class="col-sm-2 control-label">{{ field.title }}</label>
                <div class="col-sm-10">
                  <panal-inputs :field="field" :data="data">
                  </panal-inputs>
                </div>
              </div>
              <!--Fin Loop de columnas-->
            </div>
            <div class="modal-footer">
              <a type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
              <button type="submit" class="btn btn-primary">{{ modal.type }}</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /main modal -->
    <!-- derivacions modal -->
    <div class="modal fade derivaciones" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Derivar Solicitud</h4>
          </div>
          <form class="form-horizontal" v-on:submit.prevent="derivacionesSubmit(tipo)">
            <div class="modal-body smart-modal-form">
              <div class="form-group">
                <label for="derivado_el" class="col-sm-2 control-label">Fecha</label>
                <div class="col-sm-10">
                  <panal-calendar name="derivado_el" :value="derivaciones_data.derivado_el"></panal-calendar>
                </div>
              </div>
              <div class="form-group">
                <label for="area_id" class="col-sm-2 control-label">Area</label>
                <div class="col-sm-10">
                  <select class="form-control" name="area_id" id="area_id" v-model="derivaciones_data.area_id" required>
                      <option v-for="area in areas" :value="area.id">{{ area.nombre }}</option>
                    </select>
                </div>
              </div>
              <div class="form-group">
                <label for="agente_id" class="col-sm-2 control-label">Agente</label>
                <div class="col-sm-10">
                  <select class="form-control" name="agente_id" id="agente_id" v-model="derivaciones_data.agente_id" required>
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
  import {
    Lang
  } from './table.lang.js';

  export default {
    name: 'panal-tabla-solicitudes',

    props: {
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
        default: true
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

    data: function () {
      var self = this;

      return {
        rows: [],
        data: {},
        derivaciones_data: {
          derivacion_id: '',
          solicitud_id: '',
          derivado_el: '',
          agente_id: '',
          area_id: '',
          observaciones: ''
        },
        solicitudes: [],
        areas: [],
        agentes: [],
        tipo: '',
        modal: {},
        route: self.hasModal ? {} : {
          create: Router.route(self.url.doble + '.create'),
          edit: function (id) {
            return Router.route(self.url.doble + '.edit', {
              id: id
            })
          },
        },
        apiRoute: _.join([API, self.url.simple, ''], '.'),
      }
    },

    mounted() {
      var self = this;
      Events.$emit('indicator.show');
      self.setObjectsFromFormFields()
        .fetchDataFromApi()
        .makeDomFixes()
        .derivacionesPrepared();
      Events.$on('calendar.value.fromChildren', (value) => {
        self.derivaciones_data.derivado_el = value;
      });
    },

    methods: {
      setObjectsFromFormFields: function () {
        var self = this;
        _.each(self.fields, (val) => {
          self.data[val] = '';
        });

        return this;
      },

      fetchDataFromApi: function () {
        var self = this;
        self.$http.get(Router.route(self.apiRoute + 'index')).then((res) => {
          if (res.ok) {
            self.rows = res.body.data;
          }
          self.startSmartTable();
          Events.$emit('indicator.hide');
        });

        return this;
      },

      startSmartTable: function () {
        setTimeout(function () {
          this.table = $('#smartTable').DataTable({
            "language": Lang,
            "aoColumnDefs": [{
              'bSortable': false,
              'aTargets': [-1]
            }],
          });
        }, 50);

        return this;
      },

      reloadSmartTable: function () {
        var self = this;
        $('#smartTable').DataTable({
          destroy: true
        }).destroy();
        self.fetchDataFromApi();

        return this;
      },

      makeDomFixes: function () {
        setTimeout(function () {
          window.$('#smartTable_length, #smartTable_filter').parent().addClass('col-xs-6')
          window.$('#smartTable_wrapper').addClass('mt-20 ');
        }, '2000');

        return this;
      },

      submit: function (type) {
        var self = this;
        (type == 'create') ? self.create(): self.update();
      },

      createModal: function () {
        var self = this;
        self.data = {}; // Initalized as empty object :)
        self.modal = {
          type: 'Agregar',
          action: 'create'
        };
      },

      create: function () {
        var self = this;
        Events.$emit('indicator.show');

        $('#modal').modal('toggle');

        self.$http.post(Router.route(self.apiRoute + 'store'), self.data).then((res) => {
          self.reloadSmartTable();
          Events.$emit('indicator.hide');

        }, (err) => {
          console.error('Error: ', err);
        });
      },

      updateModal: function (id) {
        var self = this;
        self.data = _.find(self.rows, {'id': id}); // Find the current data in the row array, and load the modal input
        self.modal = {
          type: 'Editar',
          action: 'update'
        };
      },

      update: function () {
        var self = this;
        Events.$emit('indicator.show');

        self.$http.put(Router.route(self.apiRoute + 'update', {
          [self.model.plural]: self.data.id
        }), self.data).then((res) => {
          self.reloadSmartTable();
          Events.$emit('indicator.hide');
          $('#modal').modal('toggle');
        });
      },

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
              self.reloadSmartTable();
              Events.$emit('indicator.hide');
            });

          });
      },

      toggleDerivacionModal: () => {
        $('.derivaciones').modal('toggle')
        return this;
      },

      clearDerivacionesData: () => {
        return {
          derivacion_id: '',
          solicitud_id: '',
          derivado_el: '',
          agente_id: '',
          area_id: '',
          observaciones: ''
        }
      },

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

      onClickDerivacion: function (solicitud_id) {
        var self = this;
        var solicitudHasDerivacion = _.find(self.derivaciones, {'solicitud_id': solicitud_id});

        self.toggleDerivacionModal();

        // UPDATE
        if(!_.isUndefined(solicitudHasDerivacion) ){
          self.tipo = 'update';
          self.derivaciones_data = solicitudHasDerivacion;
          Events.$emit('calendar.value.fromParent', self.derivaciones_data.derivado_el);

          return this;
        }
        // CREATE
        self.tipo = 'store';
        self.derivaciones_data = self.clearDerivacionesData();
        Events.$emit('calendar.value.fromParent', self.derivaciones_data.derivado_el);

        return this;
      },

      derivacionesSubmit: function (tipo) {
        var self = this;
        (self.tipo == 'store') ? self.derivacionStore(): self.derivacionUpdate();
      },

      derivacionStore: function () {
        var self = this;
        Events.$emit('indicator.show');

        self.$http.post(Router.route(API + '.solicitudes.derivaciones.store'), self.derivaciones_data).then((res) => {
          self.toggleDerivacionModal();
          Events.$emit('indicator.hide');
        }, (err) => {
          console.error('Error: ', err);
        });
      },

      derivacionUpdate: function () {
        var self = this;
        self.toggleDerivacionModal();
        Events.$emit('indicator.show');

        self.$http.put(Router.route(API + '.solicitudes.derivaciones.update', {
          'derivaciones': self.derivaciones_data.derivacion_id
        }), self.derivaciones_data).then((res) => {
          Events.$emit('indicator.hide');
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
