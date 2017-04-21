<template>
  <span>
    <input class="form-control" type="text" :id="nombre" :name="nombre" v-model="valorMutable" :list="datalistName" @keyup="changed">

    <datalist :id="datalistName">
      <option v-for="sugerencia in sugerencias" :value="sugerencia.nombre" />
    </datalist>
  </span>
</template>

<script>
  export default {
    name: 'dposs-calles-autocomplete',
    props: {
      nombre: {
        type: String,
        required: true
      },
      valor: {
        type: String,
        required: true
      }
    },
    data() {
      return {
        sugerencias: [],
        datalistName: this.nombre + 'dt',
        valorMutable: this.valor
      }
    },
    methods: {
      changed() {
        if (this.valorMutable.length > 2) {
          const url = Laravel.baseUrl + '/' + laroute.route('solicitudes::calles.busqueda', {nombre: this.valorMutable});
          this.$http.get(url)
            .then((response) => {this.sugerencias = response.data.slice(0,9)});
        }
        else {
          this.sigerencias = [];
        }
      }
    }
  }
</script>
