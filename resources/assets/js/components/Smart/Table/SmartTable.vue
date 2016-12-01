<template>
  <div class="box box-primary">

    <div class="box-header with-border">
      <h3 class="box-title">Lista de {{ model.plural }}</h3>
    </div>

    <!--box-body-->
    <div class="box-body">

      <div class="row">
        <div class="col-md-12 mb-25">
          <button class="btn btn-primary pull pull-right" v-on:click="createModal" name="btnadd" data-toggle="modal" data-target="#modal" id="modalBtn">
            <i class="fa fa-plus"></i> Agregar {{ model.singular }}
          </button>
        </div>
      </div>

      <div class="row">
        <!-- Table container -->
        <div class="col-md-12 table-container table-responsive">
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
                    <a role="button" class='btn btn-primary btn-sm' v-on:click="updateModal(row.id)" data-toggle="modal" data-target="#modal">
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
        <!--End table container-->
      </div>

    </div>
    <!--end box-body-->

    <div class="overlay loading-indicator" style="display: none;">
      <i class="fa fa-refresh fa-spin"></i>
    </div>

    <!-- main modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">{{ modal.type }} {{ model.singular }}</h4>
          </div>

          <form class="form-horizontal" v-on:submit.prevent="submit(modal.action)">
            <div class="modal-body smart-modal-form">
              <div class="messages"></div>

              <!--Loop de columnas-->
              <div class="form-group" v-for="field in fields" :key="field.id">
                <label v-bind:for="field" class="col-sm-2 control-label">{{ field.title }}</label>
                <div class="col-sm-10">

                  <input v-if="field.type === 'text'"
                    class="form-control"
                    type="text"
                    v-bind:id="field.id"
                    v-model="data[field.name]"
                    v-bind:name="field.name"
                    v-bind:placeholder="field.title"
                    v-bind:required="field.required">

                  <input v-if="field.type === 'color'"
                    class="form-control"
                    type="color"
                    v-bind:id="field.id"
                    v-model="data[field.name]"
                    v-bind:name="field.name"
                    v-bind:placeholder="field.title"
                    v-bind:required="field.required">

                  <textarea v-if="field.type === 'textarea'"
                    class="form-control"
                    v-bind:id="field.id"
                    v-model="data[field.name]"
                    v-bind:name="field.name"
                    v-bind:placeholder="field.title"
                    v-bind:required="field.required">
                  </textarea>

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
        name: 'SmartTable',
        props: {
            fields: {
                type: Array,
                default: () => [],
                required: true
            },
            showTfoot:{
                type: Boolean,
                default: false
            },
            model:{
                type: Object,
                default: function(){
                  return {singular:'', plural: ''};
                },
            },
            url:{
                type: String,
                default: '',
                required: true
            }
        },

        data : function() {
            return {
                rows : [],
                data: {},
                modal: {},
            }
        },

        mounted() {
          this.setObjectsFromFormFields()
              .fetchDataFromApi();
        },

        methods : {
            showLoading: function(){
              $('.loading-indicator').show();

              return this;
            },

            hideLoading: function(){
              setTimeout(() => {
                $('.loading-indicator').hide();
              }, 500);

              return this;
            },

            setObjectsFromFormFields: function(){
              _.each(this.fields, (val)=>{
                this.data[val] = '';
              });

              return this;
            },

            fetchDataFromApi : function(){
              this.showLoading().$http.get(`${API}/${this.url}`).then((res) => {
                if (res.ok) {
                  this.rows = res.body.data;
                }
                this.startSmartTable().hideLoading();
              });

              return this;
            },

            startSmartTable: function(){
              setTimeout(function(){
                this.table = $('#smartTable' ).DataTable({
                  "language": Lang,
                  "aoColumnDefs": [
                    { 'bSortable': false, 'aTargets': [ -1 ] }
                  ],
                });
              }, 50);

              return this;
            },

            reloadSmartTable: function(){
              $('#smartTable' ).DataTable({
                destroy: true
              }).destroy();
              this.fetchDataFromApi();

              return this;
            },

            submit: function(type){
              (type == 'create') ? this.create() : this.update();
            },

            createModal: function(){
              this.data = {}; // Initalized as empty object :)
              this.modal= {type:'Agregar', action: 'create'};
            },

            create: function(){
              console.log(this.data);

              $('#modal').modal('toggle');
              this.$http.post(`${API}/${this.url}`, this.data).then((res) => {
                this.showLoading().reloadSmartTable().hideLoading();
              });
           },

           updateModal: function(id){
             this.data = _.find(this.rows, {'id':id}); // Find the current data in the row array, and load the modal inputs
             this.modal= {type:'Editar', action: 'update'};
           },

           update: function(){
             this.$http.put(`${API}/${this.url}/${this.data.id}`, this.data).then((res) => {
                this.showLoading().reloadSmartTable().hideLoading();
                $('#modal').modal('toggle');
              });
           },

           destroy: function(id){
              swal({
                title: "Estás seguro/a?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Si, borrar",
                closeOnConfirm: false
              },
              function(){
                this.showLoading();
                this.$http.delete(`${API}/${this.url}/${id}`).then((res) => {
                  this.rows = _.reject(this.rows, {'id':id});
                  this.reloadSmartTable().hideLoading();
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
