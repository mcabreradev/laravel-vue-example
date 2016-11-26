<template>
  <div class="box box-primary">

    <div class="box-header with-border">
      <h3 class="box-title">Lista de {{ model }}s</h3>
    </div>

    <!--box-body-->
    <div class="box-body">

      <div class="col-md-12 mb-25">
         <button class="btn btn-primary pull pull-right" name="btnadd" data-toggle="modal" data-target="#addMember" id="addMemberModalBtn">
          <i class="fa fa-plus"></i> Agregar {{ model }}
        </button>
      </div>

      <!-- Table container -->
      <div class="col-md-12 table-container">
        <table id="smartTable" class="table table-striped table-hover table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th v-for="col in cols">{{ col }}</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tfoot v-if="showTfoot">
            <tr>
              <th v-for="col in cols">{{ col }}</th>
              <th>Acciones</th>
            </tr>
          </tfoot>
          <tbody>
            <tr v-for="row in rows">
              <td v-for="col in cols">{{ row[col] }}</td>
              <td>
                <div>
                  <a href="/" class='btn btn-primary btn-sm'>
                    <span class="fa fa-pencil"></span>
                  </a>

                  <a class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro/a?')">
                    <span class="fa fa-trash"></span>
                  </a>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!--End table container-->

      <!-- End Table container -->
    </div>
    <!--end box-body-->

    <div class="overlay loading-indicator" style="display: none;">
      <i class="fa fa-refresh fa-spin"></i>
    </div>

    <!-- add modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="addMember">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Agregar {{ model }}</h4>
          </div>

          <form class="form-horizontal" type="POST">
            <div class="modal-body smart-modal-form">
              <div class="messages"></div>

              <!--Loop de columnas-->
              <div class="form-group" v-for="col in cols">
                <label v-bind:for="col" class="col-sm-2 control-label">{{ col }}</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" v-bind:id="col" v-model="data[col]" v-bind:name="col" v-bind:placeholder="col">
                </div>
              </div>
              <!--Fin Loop de columnas-->

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button v-on:click="create" class="btn btn-primary">Agregar</button>
              <!--<button v-on:click="greet">Greet</button>-->
            </div>
          </form>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- /add modal -->
  </div>
</template>
<script>

    import { Lang } from './table.lang.js';

    export default {
        name: 'SmartTable',
        props: {
            cols: {
                type: Array,
                default: () => []
            },
            showTfoot:{
                type: Boolean,
                default: false
            },
            model:{
                type: String,
                default: '',
                required: true
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
            }
        },

        mounted() {

          this.fetchDataFromApi().startSmartTable();
        },

        methods : {

            fetchDataFromApi : function(){
                $('.loading-indicator').show();

                this.$http.get( API + '/' + this.url).then((res) => {
                  if (res.ok) {
                    this.rows = res.body.data;
                  }
                });

                return this;
            },

            startSmartTable: function(){

              setTimeout(function(){
                $('#smartTable' ).DataTable({
                  "language": Lang,
                  "aoColumnDefs": [
                    { 'bSortable': false, 'aTargets': [ -1 ] }
                  ],
                });
                $('.loading-indicator').hide();

              }, 1000);

              return this;
            },

            create: function(){
              console.log(this.data);

           },

            greet: function (event) {
              // `this` inside methods points to the Vue instance
              alert('Hello ' + this.name + '!')
              // `event` is the native DOM event
              alert(event.target.tagName)
            },

        }
    }
</script>
<style lang="sass" scoped>

  th, .smart-modal-form label, .smart-modal-form input[placeholder] {
    text-transform: capitalize;
  }

</style>
