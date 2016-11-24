<template>
  <hr/>

  <button
    class="btn btn-default pull pull-right"
    name="btnadd"
    data-toggle="modal"
    data-target="#addMember"
    id="addMemberModalBtn">
    <i class="fa fa-plus"></i> Agregar
  </button>

  <br /> <br /> <br />


  <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
          <tr v-for="row in rows" >
              <td v-for="col in cols">{{ row[col] }}</td>
              <td></td>
          </tr>
      </tbody>

  </table>

  <!-- add modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="addMember">
     <div class="modal-dialog" role="document">
     <div class="modal-content">
     <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span>  Add Member</h4>
     </div>

     <form class="form-horizontal" action="php_action/create.php" method="POST" id="createMemberForm">

     <div class="modal-body">
        <div class="messages"></div>

             <div class="form-group"> <!--/here teh addclass has-error will appear -->
             <label for="name" class="col-sm-2 control-label">Name</label>
             <div class="col-sm-10">
             <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                <!-- here the text will apper -->
             </div>
             </div>
             <div class="form-group">
             <label for="address" class="col-sm-2 control-label">Address</label>
             <div class="col-sm-10">
             <input type="text" class="form-control" id="address" name="address" placeholder="Address">
             </div>
             </div>
             <div class="form-group">
             <label for="contact" class="col-sm-2 control-label">Contact</label>
             <div class="col-sm-10">
             <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact">
             </div>
             </div>
             <div class="form-group">
             <label for="active" class="col-sm-2 control-label">Active</label>
             <div class="col-sm-10">
             <select class="form-control" name="active" id="active">
                <option value="">~~SELECT~~</option>
                <option value="1">Activate</option>
                <option value="2">Deactivate</option>
             </select>
             </div>
             </div>

     </div>
     <div class="modal-footer">
     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
     <button type="submit" class="btn btn-primary">Save changes</button>
     </div>
     </form>
     </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- /add modal -->

</template>
<script>

  var LANG = {
      "sProcessing": "Procesando...",
      "sLengthMenu": "Mostrar _MENU_ registros",
      "sZeroRecords": "No se encontraron resultados",
      "sEmptyTable": "Ningún dato disponible en esta tabla",
      "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix": "",
      "sSearch": "Buscar:",
      "sUrl": "",
      "sInfoThousands": ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
      "sFirst": "Primero",
      "sLast": "Último",
      "sNext": "Siguiente",
      "sPrevious": "Anterior"
      },
      "oAria": {
      "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
  };

    export default {

        props: {
            cols: {
                type: Array,
                default: () => []
            },
            showTfoot:{
              default: false
            }
        },

        ready() {
          setTimeout(function(){
            $('#example').DataTable({
              "language": LANG,
            });
          }, 1000);

          this.fetchDataFromApi();
        },

        data : function() {
            return {
                rows : []
            }
        },

        methods : {

            fetchDataFromApi : function(){
                this.$http.get(API + '/solicitudes/estados').then((res) => {

                  if (res.ok) {
                    this.$set('rows', res.body.data);
                  }

                });
            }
        }
    }
</script>


<style lang="sass" scoped>
  th {
   text-transform: capitalize;
  }
</style>
