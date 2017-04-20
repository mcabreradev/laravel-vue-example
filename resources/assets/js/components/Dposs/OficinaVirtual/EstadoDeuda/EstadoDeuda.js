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
    }
  }
};
