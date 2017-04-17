/**
 *
 */
export default {
  name: "dposs-descargar-boleta",
  props: {
    conexiones: {
      type: Array,
      required: true
    }
  },

  data() {

    return {
      conexionIndex: (this.conexiones.length ? 0 : -1),
      buscarPorTipo: '',
      buscarPorValor: '',
      boletas: [],
      otros: false,
      procesando: true
    };
  },

  mounted() {
    this.getBoletas();
  },

  methods: {

    getBoletas() {
      var self     = this;
      self.boletas = [];
      self.otros   = false;

      if (self.conexionIndex < 0) {
        self.otros          = true;
        self.buscarPorTipo  = 'expediente';
        self.buscarPorValor = '';

        return self;
      }

      this.procesando = true;
      Events.$emit('indicator.show');

      var route = Laravel.baseUrl + laroute.route('oficina-virtual::boletas-de-pago-query');
      self.$http
        .post(route, self.conexiones[self.conexionIndex])
        .then(
          res => {
            self.boletas = res.body.data.filter(item => item.status == 'Descargar');
            this.procesando = false;
            Events.$emit('indicator.hide');
        },
          err => {
            console.error("Error: ", err);
            this.procesando = false;
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
