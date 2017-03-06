<template>
  <span>
    <input class="form-control" type="text" :name="nombre" v-model="valorMutable" :list="datalistName" @keyup="changed">

    <datalist :id="datalistName">
      <option v-for="sugerencia in sugerencias" :value="sugerencia.nombre">
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
        this.$http
          .get(laroute('solicitudes::calles.busqueda', {nombre: this.valorMutable}))
          .then((response) => {this.sugerencias = response.data;});
      }
    }
  }
</script>
