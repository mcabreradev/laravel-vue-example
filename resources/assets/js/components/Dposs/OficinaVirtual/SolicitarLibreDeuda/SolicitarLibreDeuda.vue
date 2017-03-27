<template>
<div>
  <panal-box-slot title="Solicitar Libre Deuda">
    <div slot="body">

      <form class="form-inline">
        <div class="form-group">
          <label>Completar con:</label>
          <select class="form-control" v-model="conexion" @change="confirmarCompletar()" width="100%">
            <option v-for="(item, index) in conexiones" :key="item.id" :value="index">{{ item.domicilio_completo }}</option>
            <option value="-1">Solicitar libre deuda para otra persona</option>
          </select>
        </div>
      </form>

      <hr>
      <h3 class="text-center">Formulario de solicitud</h3>
      <hr>

      <form method="POST" v-on:submit.stop.prevent="enviarSolicitud()">

        <div class="row">
          <legend class="col-xs-12">Datos del solicitante</legend>

          <div class="col-xs-12">
            <div class="well">
              <span class="fa-stack">
                <i class="fa fa-circle-thin fa-stack-2x"></i>
                <i class="fa fa-info fa-stack-1x"></i>
              </span>
               Recordá incluir el código de área en el teléfono
            </div>
          </div>


          <div class="col-xs-12">
            <div class="form-group">
              <label for="solicitante_nombre_completo">Nombre completo</label>
              <input v-model="usuario.name" class="form-control" name="solicitante_nombre_completo" id="solicitante_nombre_completo" placeholder="Nombre completo" type="text" required>
            </div>
          </div>

          <div class="col-xs-12 col-sm-6">
            <div class="form-group">
              <label for="solicitante_telefono">Teléfono</label>
              <input v-model="usuario.telefono" class="form-control" name="solicitante_telefono" id="solicitante_telefono" placeholder="Teléfono" type="text" required>
            </div>
          </div>

          <div class="col-xs-12 col-sm-6">
            <div class="form-group">
              <label for="solicitante_email">Email</label>
              <input v-model="usuario.email" class="form-control" name="solicitante_email" id="solicitante_email" placeholder="Email" type="email" >
            </div>
          </div>
        </div> <!-- /.row datos del solicitante -->

        <div class="row">
          <legend class="col-xs-12">Datos del titular</legend>

          <div class="col-xs-12 col-sm-6">
            <div class="form-group">
              <label for="titular_nombre">Nombre completo</label>
              <input v-model="solicitud.titular_nombre" class="form-control" name="titular_nombre" id="titular_nombre" placeholder="Nombre" type="text" required>
            </div>
          </div>

          <div class="col-xs-12 col-sm-6">
            <div class="form-group">
              <label for="titular_documento">DNI/CUIT</label>
              <input v-model="solicitud.titular_documento" class="form-control" name="titular_documento" id="titular_documento" placeholder="DNI/CUIT" type="number" required>
            </div>
          </div>
        </div> <!-- /.row datos del titular -->


        <div class="row">
          <legend class="col-xs-12">Datos de la factura</legend>

          <div class="col-xs-12">
            <div class="well">
              <span class="fa-stack">
                <i class="fa fa-circle-thin fa-stack-2x"></i>
                <i class="fa fa-info fa-stack-1x"></i>
              </span>
               Debés ingresar nomenclatura, unidad o expediente
            </div>
          </div>

          <div class="col-xs-12 col-sm-9">
            <div class="form-group">
              <label for="domicilio">Domicilio</label>
              <input v-model="solicitud.domicilio" class="form-control" name="domicilio" id="domicilio" placeholder="Domicilio" type="text">
            </div>
          </div>

          <div class="col-xs-12 col-sm-3">
            <div class="form-group">
              <label for="localidad">Localidad</label>
              <select class="form-control" id="localidad" name="localidad" required v-model="solicitud.localidad">
                <option value="Tolhuin">Tolhuin</option>
                <option value="Ushuaia">Ushuaia</option>
              </select>
            </div>
          </div>

          <div class="col-xs-12 col-sm-6">
            <div class="form-group">
              <label for="nomenclatura">
                Nomenclatura <span class="field-help label label-warning"><a href="//dposs.gob.ar/wordpress/wp-content/uploads/2016/09/help-factura-nomenclatura.jpg" target="_blank" rel="noopener noreferrer">Necesita ayuda?</a></span>
              </label>
              <input v-model="solicitud.nomenclatura" class="form-control" name="nomenclatura" id="nomenclatura" placeholder="Nomenclatura" type="text">
            </div>
          </div>

          <div class="col-xs-12 col-sm-3">
            <div class="form-group">
              <label for="expediente">
                Expediente <span class="field-help label label-warning"><a href="//dposs.gob.ar/wordpress/wp-content/uploads/2017/03/factura-ayuda-expediente.jpg" target="_blank" rel="noopener noreferrer">Necesita ayuda?</a></span>
              </label>
              <input v-model="solicitud.expediente" name="expediente" id="expediente" placeholder="Número de expediente" type="number" class="form-control">
            </div>
          </div>

          <div class="col-xs-12 col-sm-3">
            <div class="form-group">
              <label for="unidad">
                Unidad <span class="field-help label label-warning"><a href="//dposs.gob.ar/wordpress/wp-content/uploads/2016/08/help-factura.jpg" target="_blank" rel="noopener noreferrer">Necesita ayuda?</a></span>
              </label>
              <input v-model="solicitud.unidad" name="unidad" id="unidad" placeholder="Número de unidad" type="number" class="form-control">
            </div>
          </div>

          <div class="col-xs-12">
            <div class="form-group">
              <label for="descripcion">Describa dónde lo presentará</label>
              <textarea v-model="solicitud.descripcion" rows="6" id="descripcion" name="descripcion" class="form-control" required></textarea>
            </div>
          </div>
        </div> <!-- /.row datos de la factura -->


        <div class="form-group">
          <div class="pull-right">
            <span v-if="!canSend()" class="text-danger">Asegurese de completar nomenclatura, expediente o unidad</span>
            <button :class="{'disabled': !canSend(), 'no-action': !canSend()}" class="btn btn-primary btn-large" type="submit" name="action">
              <i class="fa fa-paper-plane right"></i> Solicitar
            </button>
          </div>
        </div>
      </form>

    </div>
  </panal-box-slot>
</div>

</template>

<script>
export default {
  name: "dposs-solicitar-libre-deuda",
  props: {
    conexiones: {
      type: Array,
      required: true
    },
    usuario: {
      type: Object,
      required: true
    }
  },

  data() {
    return {
      conexion: (this.conexiones.length ? 0 : -1),
      conexionOld : (this.conexiones.length ? 0 : -1),
      solicitud: {
        solicitante_nombre_completo: this.usuario.name,
        solicitante_email: this.usuario.email,
        solicitante_telefono: this.usuario.telefono,
        titular_nombre: '',
        titular_documento: 0,
        domicilio: '',
        localidad: 'Ushuaia',
        nomenclatura: '',
        expediente: '',
        unidad: '',
        descripcion: ''
      }
    };
  },

  mounted() {
    if (this.checkIfOtros()) {
      this.blanquearFormulario();
    }
    else {
      this.getBoletas();
    }

    this.$watch('conexion', (newVal, oldVal) => {
      this.conexionOld = oldVal;
    });
  },

  methods: {

    checkIfOtros() {
      return this.conexion < 0;
    },

    canSend() {
      return this.solicitud.nomenclatura != '' ||
        this.solicitud.expediente != '' ||
        this.solicitud.unidad != '';
    },

    confirmarCompletar() {
      let self = this;

      if (this.checkIfOtros()) {
        swal({
          title: "¿Segur@?",
          text: "Si continúas los algunos datos del formulario se blanquearan",
          type: "warning",
          showCancelButton: true,
          cancelButtonText: 'No, me equivoqué',
          confirmButtonColor: "#00a65a",
          confirmButtonText: "Si",
          closeOnConfirm: true
        },
        isConfirm => {
          if (isConfirm) {
            self.blanquearFormulario();
          }
          else {
            self.conexion = self.conexionOld;
          }
        });
      }
      else {
        swal({
          title: "¿Completar formulario?",
          text: "Completaremos el formulario con los datos de esta conexión",
          type: "warning",
          showCancelButton: true,
          cancelButtonText: 'No, me equivoqué',
          confirmButtonColor: "#00a65a",
          confirmButtonText: "Si, gracias",
          closeOnConfirm: true
        },
        isConfirm => {
          if (isConfirm) {
            self.getBoletas();
          }
          else {
            self.conexion = self.conexionOld;
          }
        });
      }
    },

    blanquearFormulario() {
      this.solicitud.titular_nombre    = '';
      this.solicitud.titular_documento = '';
      this.solicitud.domicilio         = '';
      this.solicitud.nomenclatura      = '';
      this.solicitud.expediente        = '';
      this.solicitud.unidad            = '';
    },

    completarFormulario(data) {
      this.solicitud.titular_nombre    = data.nombre_razon_social;
      this.solicitud.titular_documento = data.numero_cuenta;
      this.solicitud.domicilio         = data.domicilio;
      this.solicitud.nomenclatura      = data.nomenclatura;
      this.solicitud.expediente        = data.expediente;
      this.solicitud.unidad            = data.numero_unidad;
    },

    getBoletas() {
      let self  = this;
      let route = Laravel.baseUrl + laroute.route('oficina-virtual::boletas-de-pago-query');

      Events.$emit('indicator.show');

      self.$http
        .post(route, self.conexiones[self.conexion])
        .then(
          res => {
            let boletas = res.body.data;

            if (boletas.length) {
              this.completarFormulario(boletas[0]);
            }

            Events.$emit('indicator.hide');
          },
          err => {
            console.error("Error: ", err);
            Events.$emit('indicator.hide');
          }
        );

      return self;
    },

    enviarSolicitud() {
      let route = Laravel.baseUrl + laroute.route('api::v1::oficicina-virtual::pedidos.solicitar.libre-deuda');
      console.log(route)
      Events.$emit('indicator.show');

      this.$http
        .post(route, this.solicitud)
        .then(
          res => {
            swal("Solicitud enviada", "Te contactaremos en breve", "success");
            Events.$emit('indicator.hide');
          },
          err => {
            console.error("Error: ", err);
            swal("Ocurrió un error al enviar la solicitud", "Por favor intentá más tarde o comunicate con nosotros si el problema persiste", "error");
            Events.$emit('indicator.hide');
          }
        );
    }
  }
};
</script>

<style lang="sass" scoped>
  .field-help a {
    color: white;
    font-weight: 300;
    font-size: 12px;
  }

  .no-action {
    pointer-events: none;
    cursor: default;
  }
</style>
