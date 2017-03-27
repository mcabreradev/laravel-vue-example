<template>

<div>
  <div class="table-responsive">
    <table class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>Factura</th>
          <th>Periodo</th>
          <th>Titular</th>
          <th>Ocupante</th>
          <th>Domicilio</th>
          <th>Venc 1</th>
          <th>Venc 2</th>
          <th>Venc 3</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
          <tr v-for="boleta in boletas">
            <td>{{ boleta.factura }}</td>
            <td>{{ boleta.periodo }}</td>
            <td>{{ boleta.titular }}</td>
            <td>{{ boleta.nombre_ocupante }}</td>
            <td>{{ boleta.domicilio }}</td>
            <td>{{ boleta.vencimiento1 }}</td>
            <td>{{ boleta.vencimiento2 }}</td>
            <td>{{ boleta.vencimiento3 }}</td>

            <td class="actions-column">
              <div class="actions-group">

                <span v-if="boleta.status == 'Descargar'">Por pagar <a class="btn btn-primary btn-xs" :href="linkBoletaPago(boleta)" data-toggle="tooltip" data-placement="top" title="Descargar boleta de pago" target="_blank"><i class="fa fa-download"></i></a></span>

                <span v-if="boleta.status == 'Vencida'">Vencida <a class="btn btn-danger btn-xs" href="#" data-toggle="tooltip" data-placement="top" title="Solicitar factura" target="_blank"><i class="fa fa-download"></i></a></span>

            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

</template>

<script>
  export default {
    name: "dposs-facturas-adeudadas",
    props: {
      boletas: {
        type: Array,
        required: true
      }
    },

    methods: {
      linkBoletaPago: function(boleta){
        return Laravel.baseUrl +
          laroute.route('api::v1::oficicina-virtual::boletas-pago.generar') +
          `?tipo-busqueda=${boleta.buscar_por.tipo}&busqueda=${boleta.buscar_por.valor}&periodo=${boleta.periodo_factura}`;
      }
    }
  };
</script>

<style lang="sass" scoped>
  .actions-column {
    min-width: 100px;
  }
</style>
