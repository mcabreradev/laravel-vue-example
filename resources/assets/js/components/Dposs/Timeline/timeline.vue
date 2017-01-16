<template>
  <div>
    <h4>Reclamo: ""</h4>
    <br>
    <ul class="timeline">
      <!-- timeline time label -->
      <li class="time-label">
        <span class="bg-gray-light">

            </span>
      </li>
      <!-- /.timeline-label -->
      <!-- timeline item -->
      <li>
        <!-- timeline icon -->
        <i class="fa fa-envelope bg-light-blue"></i>
        <div class="timeline-item">
          <h3 class="timeline-header no-border"><b>Seguimiento:</b> #{{ solicitud }}</h3>
        </div>
      </li>
      <!-- END timeline item -->
      <li>
        <i class="fa fa-clock-o bg-light-blue"></i>
      </li>
    </ul>
  </div>
</template>
<script>
  export default {
    name: 'dopss-timeline',
    props: {
      solicitud: {
        type: String,
        required: true
      },
    },
    data: () => {
      return {
        seguimientos: [],
        derivaciones: [],
        timeline: []
      }
    },
    mounted() {

    },
    methods: {
      getSegumientos: () => {
        var self = this;
        self.$http
          .get(Router.route(API + '.solicitudes.derivaciones.index'))
          .then((res) => {
            this.derivaciones = res.body.data;
          }, (err) => {
            console.error('Error: ', err);
          });
      },
    },
  }

</script>
