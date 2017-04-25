<template>
  <div>
    <div class="well text-center" v-if="turnos.length === 0">No hay turnos</div>

    <div class="table-responsive" v-if="turnos.length > 0">
      <table class="table table-bordered">
        <thead>
          <tr class="active">
            <th>Fecha</th>
            <th>Hora</th>
            <th>Apellido</th>
            <th>Nombre</th>
            <th>DNI</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>Observaciones</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-bind:class="{ 'success': turno.atendido }" v-for="(turno, index) in turnos">
            <td>{{ turno.fecha | dateOnly }}</td>
            <td>{{ (turno.fecha+'T'+turno.hora) | hourSecondsOnly }}</td>
            <td>{{ turno.usuario.apellido }}</td>
            <td>{{ turno.usuario.nombre }}</td>
            <td>{{ turno.usuario.documento }}</td>
            <td>{{ turno.usuario.movil }}</td>
            <td>{{ turno.usuario.email }}</td>
            <td>{{ turno.observaciones }}</td>
            <td>
              <button v-if="!turno.atendido" @click="seleccionarTurno(turno)" class="btn btn-primary btn-sm" title="Validar atención">
                <span class="fa fa-check"></span>
              </button>
              <button v-if="!turno.atendido" @click="cancelar(index)" class="btn btn-danger btn-sm" type="submit" title="Cancelar turno">
                <span class="fa fa-times"></span>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Validar atención turno</h4>
          </div>
          <div class="modal-body" v-if="turno !== null">

            <div class="alert alert-info" role="alert">
              <p>Revisá que la información sea correcta antes de confirmar el turno</p>
            </div>

            <div class="form-group">
              <label for="usuario-apellido">Apellido</label>
              <input id="usuario-apellido" name="usuario-apellido" class="form-control" type="text" v-model="turno.usuario.apellido">
            </div>

            <div class="form-group">
              <label for="usuario-nombre">Nombre</label>
              <input id="usuario-nombre" name="usuario-nombre" class="form-control" type="text" v-model="turno.usuario.nombre">
            </div>

            <div class="form-group">
              <label for="usuario-documento">DNI/CUIT</label>
              <input id="usuario-documento" name="usuario-documento" class="form-control" type="text" v-model="turno.usuario.documento">
            </div>

            <div class="form-group">
              <label for="usuario-movil">Teléfono</label>
              <input id="usuario-movil" name="usuario-movil" class="form-control" type="text" v-model="turno.usuario.movil">
            </div>

            <div class="form-group">
              <label for="usuario-email">Correo electrónico</label>
              <input id="usuario-email" name="usuario-email" class="form-control" type="text" v-model="turno.usuario.email">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-success" @click="validarAtencion()">Confirmar atención</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  </div>
</template>


<script>
  export default {
    name: 'TurnosTable',

    props: {
      urlContenidos: {
        type: String,
        default: '',
        required: true
      },
      urlValidar: {
        type: String,
        default: '',
        required: true
      },
      urlDelete: {
        type: String,
        default: '',
        required: true
      }
    },

    data: function() {
      return {
        turnos: [],
        turno: null
      }
    },

    mounted: function() {
      var self = this;
      self.getTurnos();
      setInterval(function(){ self.getTurnos() }, 5000);
    },

    methods: {
      cancelar: function(turnoIndex) {
        var self  = this;
        var turno = self.turnos[turnoIndex];

        window.swal(
          {
            title: "¿Querés cancelar el turno?",
            text: "El turno se va a canelar",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: 'Me equivoqué',
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Cancelar el turno',
            closeOnConfirm: false,
            showLoaderOnConfirm: true
          },
          function() {
            window.$.ajax({
              url: self.urlDelete + '/' + turno.id,
              method: 'POST',
              data: {
                _token: window.Laravel.csrfToken,
                _method: 'delete'
              }
            }).done(function(data){
              self.turnos.splice(turnoIndex, 1);
              window.swal('Éxito!', 'El turno se borró correctamente', 'success');
            }).fail(function(){
              window.swal('Ops!', 'Algo salió mal. Intentalo nuevamente', 'error');
            });
          }
        );
      }, // cancelar,

      validarAtencion: function() {
        var self = this;

        window.$.ajax({
          url: self.urlValidar + '/' + self.turno.id,
          method: 'POST',
          data: {
            _token: window.Laravel.csrfToken,
            _method: 'put',
            usuario: self.turno.usuario
          }
        }).done(function(data){
          self.getTurnos();
          window.$(self.$el.getElementsByClassName('modal')[0]).modal('hide');
          swal('Éxito!', 'El turno se borró correctamente', 'success');
        }).fail(function(){
          swal('Ops!', 'Algo salió mal. Intentalo nuevamente', 'error');
        });
      },

      getTurnos: function() {
        var self = this;

        this.$http
          .get(this.urlContenidos)
          .then(response => {self.turnos = response.data});
      },

      openModal: function() {
        window.$(this.$el.getElementsByClassName('modal')[0]).modal('show');
      },

      seleccionarTurno: function(turno) {
        this.turno = turno;
        this.openModal();
        // validarTurnoVue.$children[0].$set('successCallback', this.getTurnos);
        // validarTurnoVue.$children[0].openModal();
      }
    } // methods
  };
</script>
