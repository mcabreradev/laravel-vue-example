<template>
  <div class="box box-primary">

    <div class="box-header with-border">
      <h3 class="box-title">Lista de <span class="text-capital">{{ model.plural }}</span></h3>
    </div>

    <!--box-body-->
    <div class="box-body">

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 mb-25">
          <button class="btn btn-primary pull pull-right" v-if="hasModal" v-on:click="createModal" name="btnadd" data-toggle="modal" data-target="#modal" id="modalBtn">
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
                    <div v-if="field.name === 'color'"
                      role="button"
                      v-bind:style="{'background-color': row[field.name]}"
                      class="color-square"
                      v-on:click="updateModal(row.id)"
                      data-toggle="modal"
                      data-target="#modal">
                    </div>

                    <div v-else>{{ row[field.name] }}</div>
                  </td>
                  <td>
                    <div>
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

    <s-indicator></s-indicator>

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

                  <s-inputs
                    :field="field"
                    :data="data">
                  </s-inputs>

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


  </div>
</template>

<script>

  import { Lang } from './table.lang.js';

  export default {
    name: 's-table',

    props: {
      fields: {
        type: Array,
        default: () => { return [] },
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
        default: function() {
          return { singular: '', plural: '' };
        },
      },
      url: {
        type: Object,
        default: () => { return {} },
        required: true
      }
    },

    data: function() {
      var vm = this;

      return {
        rows: [],
        data: {},
        modal: {},
        route: vm.hasModal ? {} : {
          create: Router.route(vm.url.doble + '.create') ,
          edit: function(id){
            return Router.route(vm.url.doble + '.edit', {id:id})
          },
        },
        apiRoute: _.join([API, vm.url.simple, ''], '.'),
      }
    },

    mounted() {
      Events.$emit('indicator.show');

      this.setObjectsFromFormFields()
        .fetchDataFromApi()
        .makeDomFixes();
    },

    methods: {

      setObjectsFromFormFields: function() {
        _.each(this.fields, (val) => {
          this.data[val] = '';
        });

        return this;
      },

      fetchDataFromApi: function() {

        this.$http.get(Router.route(this.apiRoute + 'index')).then((res) => {
          if (res.ok) {
            this.rows = res.body.data;
          }
          this.startSmartTable();
          Events.$emit('indicator.hide');
        });

        return this;
      },

      startSmartTable: function() {
        setTimeout(function() {
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

      reloadSmartTable: function() {
        $('#smartTable').DataTable({
          destroy: true
        }).destroy();
        this.fetchDataFromApi();

        return this;
      },

      makeDomFixes: function(){
        setTimeout(function(){
          window.$('#smartTable_length, #smartTable_filter').parent().addClass('col-xs-6')
          window.$('#smartTable_wrapper').addClass('mt-20 ');
        },'2000');

        return this;
      },

      submit: function(type) {
        (type == 'create') ? this.create(): this.update();
      },

      createModal: function() {
        this.data = {}; // Initalized as empty object :)
        this.modal = {
          type: 'Agregar',
          action: 'create'
        };
      },

      create: function() {
        Events.$emit('indicator.show');

        $('#modal').modal('toggle');

        this.$http.post(Router.route(this.apiRoute + 'store'), this.data).then((res) => {
          this.reloadSmartTable();
          Events.$emit('indicator.hide');
        });
      },

      updateModal: function(id) {
        this.data = _.find(this.rows, {'id': id}); // Find the current data in the row array, and load the modal input
        this.modal = {type: 'Editar', action: 'update'};
      },

      update: function() {
        Events.$emit('indicator.show');

        this.$http.put(Router.route(this.apiRoute + 'update', { [this.model.plural] : this.data.id}), this.data).then((res) => {
          this.reloadSmartTable();
          Events.$emit('indicator.hide');
          $('#modal').modal('toggle');
        });
      },

      destroy: function(id) {
        var vm = this;

        swal({
            title: "Estás seguro/a?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, borrar",
            closeOnConfirm: true
          },
          function() {
            Events.$emit('indicator.show');
            vm.$http.delete(Router.route(vm.apiRoute + 'destroy', { [vm.model.plural] : id})).then((res) => {
              vm.rows = _.reject(vm.rows, {'id': id});
              vm.reloadSmartTable();
              Events.$emit('indicator.hide');
            });

          });
      },

    }
  }
</script>

<style lang="sass" scoped>
  .color-square{
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

  .close{
    color: #fff;
    opacity: 0.7;
  }

  .close:hover{
    opacity: 0.9;
  }
</style>
