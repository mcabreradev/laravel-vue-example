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
      this.getAll();
    },
    methods: {

      getAll: function() {
        var self = this;
        self.getDerivaciones();

        return self;
      },

      getDerivaciones: function(){
        var self = this;
        self.$http
          .get(Router.route(API + '.solicitudes.derivaciones.index'))
          .then((res) => {
            console.log('derivaciones');
            this.derivaciones = res.body.data;

            self.getSeguimientos();
          }, (err) => {
            console.error('Error: ', err);
          });

        return self;
      },
      getSeguimientos: function(){
        var self = this;
        self.$http
          .get(Router.route(API + '.solicitudes.seguimientos.index'))
          .then((res) => {
            console.log('seguimientos');
            this.seguimientos = res.body.data;

            self.mergeAll();
          }, (err) => {
            console.error('Error: ', err);
          });

        return self;
      },

      mergeAll: function (){
        var self = this;

        self.timeline = _.concat(self.derivaciones, self.seguimientos);

        _.each(self.timeline, (val, key) => {
          return self.timeline[key]['datetime'] = !_.isUndefined(val.derivado_el) ? val.derivado_el: val.generado_el;
          return self.timeline[key]['tipo']     = !_.isUndefined(val.derivado_el) ? 'derivacion' : 'seguimiento';
        });
        console.log('merge', self.timeline);

        return self;
      }
    },
  }

</script>
