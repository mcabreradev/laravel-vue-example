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

  data: () => {
    return {
      conexion : '',
      buscarSelect : '',
      buscarInput: '',
      boletas: [],
      otros: false
    };
  },

  mounted() {

  },

  methods: {

    getBoletas: function() {
      var self = this;
      self.boletas = [];
      self.otros = false;

      if(!_.isObject(self.conexion)){

        if(self.conexion == 'otros'){
          self.otros = true;
          self.buscarSelect = '';
          self.buscarInput = '';
        }

        return self;
      }

      Events.$emit('indicator.show');

      var route = Laravel.baseUrl + laroute.route('oficina-virtual::boletas-de-pago-query');
      self.$http
        .post(route, self.conexion)
        .then(
          res => { self.boletas = res.body.data; Events.$emit('indicator.hide'); },
          err => { console.error("Error: ", err); Events.$emit('indicator.hide'); }
        );

      return self;
    },

    linkBoletaPago: function(boleta){
      return Laravel.baseUrl +
        laroute.route('api::v1::oficicina-virtual::boletas-pago.generar') +
        `?tipo-busqueda=${boleta.buscar_por.tipo}&busqueda=${boleta.buscar_por.valor}&periodo=${boleta.periodo_factura}`;
    }
  }
};
