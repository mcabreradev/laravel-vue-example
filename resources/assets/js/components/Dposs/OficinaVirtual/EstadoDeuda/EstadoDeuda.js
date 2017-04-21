/**
 *
 */
export default {
  name: "dposs-estado-deuda",
  props: {
    conexiones: {
      type: Array,
      required: true
    },
    user: {
      type: Object,
      required: true
    }
  },

  data() {

    return {
      conexionIndex: 0,
      deudas: [],
      procesando: true
    };
  },

  computed: {
    totalesDedudas() {
      let totales = {
        monto: 0,
        posibles_punitorios: 0,
        suma: 0
      };

      for (var i = this.deudas.length - 1; i >= 0; i--) {
        totales.monto += this.deudas[i].monto;
        totales.posibles_punitorios += this.deudas[i].posibles_punitorios
      }

      totales.suma = totales.monto + totales.posibles_punitorios;

      let formater = new Intl.NumberFormat('es-AR', {style: 'currency', currency: 'ARS'});
      totales.monto_format = formater.format(totales.monto);
      totales.posibles_punitorios_format = formater.format(totales.posibles_punitorios);
      totales.suma_format = formater.format(totales.suma);

      return totales;
    }
  },

  mounted() {
    this.getDeudas();
  },

  methods: {

    getDeudas() {
      var self     = this;
      var conexion = self.conexiones[self.conexionIndex];
      var route    = Laravel.baseUrl +
        laroute.route('oficina-virtual::conexiones.deudas', {conexion: conexion.id});

      self.deudas = [];

      Events.$emit('indicator.show');
      self.procesando = true;

      self.$http.get(route)
        .then(
          res => {
            self.deudas = res.body;
            Events.$emit('indicator.hide');
            self.procesando = false;
          },
          err => {
            console.error("Error: ", err);
            Events.$emit('indicator.hide');
            self.procesando = false;
          }
        );

      return self;
    },

    linkBoletaPago(boleta){
      return Laravel.baseUrl +
        laroute.route('api::v1::oficicina-virtual::boletas-pago.generar') +
        `?tipo-busqueda=${boleta.buscar_por.tipo}&busqueda=${boleta.buscar_por.valor}&periodo=${boleta.periodo_factura}`;
    },

    solicitarFacturaVencida(factura) {
      var solicitud = {
        solicitante_apellido: this.user.name,
        solicitante_nombre: '',
        solicitante_telefono: this.user.telefono,
        solicitante_email: this.user.email,
        domicilio: factura.domicilio,
        localidad: 'Ushuaia',
        nomenclatura: factura.nomenclatura,
        unidad: factura.numero_unidad,
        periodo: factura.periodo,
        entrega: 'Por email',
        comentarios: 'Desde Oficina Virtual'
      }

      var route = Laravel.baseUrl + laroute.route('api::v1::oficicina-virtual::pedidos.solicitar.facturas-vencidas')

      swal({
        title: "Recibirás la factura por email",
        text: "Recordá que al ser una factura vencida sólo puede pagarse en " +
          "nuestras oficinas. El monto final será recalculado al momento del pago, con los intereses que correspondan.",
        type: "success",
        showCancelButton: false,
        confirmButtonText: "Entendido",
        closeOnConfirm: true
      });

      this.$http.post(route, solicitud)
        .then(
          res => {
            console.log('exito', res)
          },
          err => {
            console.error("Error: ", err);
          }
        );
    }
  }
};
