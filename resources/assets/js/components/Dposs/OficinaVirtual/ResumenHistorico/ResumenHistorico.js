/**
 *
 */
export default {
  name: "dposs-resumen-historico",
  props: {
    conexiones: {
      type: Array,
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
    this.getBoletas();
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

    linkBoletaPago: function(boleta){
      return Laravel.baseUrl +
        laroute.route('api::v1::oficicina-virtual::boletas-pago.generar') +
        `?tipo-busqueda=${boleta.buscar_por.tipo}&busqueda=${boleta.buscar_por.valor}&periodo=${boleta.periodo_factura}`;
    },

    linkBoletaPagoManual: function(buscarPorTipo, buscarPorValor){
      return (_.isEmpty(buscarPorTipo) || _.isEmpty(buscarPorValor)) ? null : Laravel.baseUrl +
        laroute.route('api::v1::oficicina-virtual::boletas-pago.generar') +
        `?tipo-busqueda=${buscarPorTipo}&busqueda=${buscarPorValor}`;
    },
  }
};
