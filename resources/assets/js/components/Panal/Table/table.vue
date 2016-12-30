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
            <i class="fa fa-plus"></i> Agregar <span class="text-capital">{{ model.singular }}</span>
          </a>

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
                    <!-- si es un imput de color / colorpicker -->
                    <div v-if="field.name === 'color'"
                      role="button"
                      v-bind:style="{'background-color': row[field.name]}"
                      class="color-square"
                      v-on:click="openUpdateModal(row.id)"
                      data-toggle="modal"
                      data-target="#modal">
                    </div>

                    <div v-else>{{ row[field.name] }}</div>
                  </td>
                  <td>
                    <div>
                      <a role="button" class='btn btn-primary btn-sm' v-if="hasModal" v-on:click="openUpdateModal(row.id)" data-toggle="modal" data-target="#modal">
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

                  <panal-inputs
                    :field="field"
                    :data="data">
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


  </div>
</template>

<script>

  import { Lang } from './table.lang.js';

  export default {
    name: 'panal-table',

    props: {
      title: {
        type: String,
        default: () => {},
        required: false
      },
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
        default: true,
        required: false
      },
      where: {
        default: false,
        required: false
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
      },
      params: {
        type: Object,
        default: () => { return {} },
        required: false
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
      var self = this;

      Events.$emit('indicator.show');

      this.checkEvents()
        .setObjectsFromFormFields()
        .fetchDataFromApi()
        .makeDomFixes();
    },

    methods: {

      /**
       *  Funcion para que checkar eventos, se tiggerea desde el metodo mount()
      **/
      checkEvents : function(){
        var self = this;

        Events.$on('calendar.value.fromChildren', (value) => {
          self.data[self.getCalendarFieldName()] = value;
        });

        return self;
      },

      getCalendarFieldName: function(){
        var field = _.find(this.fields, {type: 'calendar'});

        if (!_.isUndefined(field) ){
          return field.name;
        }
        return false;
      },

      setObjectsFromFormFields: function() {
        _.each(this.fields, (val) => {
          this.data[val.name] = '';
          if(val.type == 'hidden'){
              this.data[val.name] = val.value;
          }

        });

        return this;
      },

      toggleModal: function(){
        $('#modal').modal('toggle');
        return this;
      },

      fetchDataFromApi: function() {
        var self = this;

        // Default query route for index
        var route = Router.route(self.apiRoute + 'index');

        // query with conditions
        if (self.where){
          route = Router.route(self.apiRoute + 'show', { [self.model.plural] : self.where.id});
        }

        self.$http.get(route).then((res) => {
          if (res.ok) {
            self.rows = res.body.data;
          }
          self.startSmartTable();
          Events.$emit('indicator.hide');
        },
        (err) =>{
          console.error('Error:: ', err);
        });

        return self;
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

      openCreateModal: function() {
        var self = this;
        self.setObjectsFromFormFields();
        self.toggleModal();
        self.modal = {
          type: 'Agregar',
          action: 'create'
        };
      },

      openUpdateModal: function (id) {
          var self = this;
          self.data = _.find(self.rows, { 'id': id }); // Find the current data in the row array, and load the modal input
          self.modal = { type: 'Editar', action: 'update' };

          if (self.getCalendarFieldName() ){
            Events.$emit('calendar.value.fromParent', self.data[self.getCalendarFieldName()]);
          }
        },

      create: function() {
        var self = this;
        Events.$emit('indicator.show');
        self.toggleModal();
        self.$http.post(Router.route(self.apiRoute + 'store'), self.data)
        .then((res) => {
          self.reloadSmartTable();
          Events.$emit('indicator.hide');
        },
        (err) =>{
          console.error('Error:: ', err);
        });
      },

      update: function() {
        var self = this;
        Events.$emit('indicator.show');

        self.$http.put(Router.route(self.apiRoute + 'update', { [self.model.plural] : self.data.id}), self.data)
        .then((res) => {
          self.reloadSmartTable();
          Events.$emit('indicator.hide');
          self.toggleModal();
        },
        (err) =>{
          console.error('Error:: ', err);
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
            () => {
              Events.$emit('indicator.show');
              self.$http.delete(Router.route(self.apiRoute + 'destroy', { [self.model.plural]: id })).then((res) => {
                self.rows = _.reject(self.rows, { 'id': id });
                self.reloadSmartTable();
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
