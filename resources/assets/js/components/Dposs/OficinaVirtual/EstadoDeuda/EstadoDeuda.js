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

  mounted() {
    this.getDeudas();
  },

  methods: {

    getDeudas() {
      var self     = this;
      var conexion = self.conexiones[self.conexionIndex];
      var route    = Laravel.baseUrl +
        laroute.route('oficina-virtual::conexiones.estado-deuda', {conexion: conexion.id});

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
