/**
 *
 */
export default {
  name: "dposs-resumen-historico",
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
      facturas: []
    };
  },

  mounted() {
    this.getFacturas();
  },

  methods: {

    getFacturas() {
      var self     = this;
      var conexion = self.conexiones[self.conexionIndex];
      var route = Laravel.baseUrl +
        laroute.route('oficina-virtual::conexiones.facturas', {conexion: conexion.id});

      self.facturas = [];

      Events.$emit('indicator.show');

      self.$http.get(route)
        .then(
          res => {
            self.facturas = res.body;
            Events.$emit('indicator.hide');
          },
          err => {
            console.error("Error: ", err);
            Events.$emit('indicator.hide');
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
