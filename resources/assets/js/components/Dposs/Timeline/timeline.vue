<template>
  <div>
    <h4>Reclamo: {{ solicitud }}</h4>
    <br>
    <ul class="timeline">
      <template v-for="(items, i) in timeline">
        <template v-for="(item, j) in items">
          <li v-if="j == 0" class="time-label"><span class="bg-blue">{{ item | dateOnly }}</span></li>
          <li v-else>
            <i v-if="item.tipo == 'Seguimiento'" class="fa fa-commenting-o bg-orange" :title="item.tipo"></i>
            <i v-else class="fa fa-paper-plane bg-green" :title="item.tipo"></i>
            <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> {{ item.datetime | hourSecondsOnly}} hs</span>
              <h3 class="timeline-header no-border"><b>{{ item.tipo }}:</b> #{{ item.id }}</h3>
              <div class="timeline-body">{{ item.comentario }}</div>
            </div>
          </li>
        </template>
      </template>
      <li v-if="timeline.length > 0"><i class="fa fa-clock-o bg-gray"></i></li>
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
        timeline: []
      }
    },

    mounted() {
      this.getAll();
    },
    methods: {

      getAll: function() {
        var self = this;
        self.getSolicitudes();

        return self;
      },

      getSolicitudes: function(){
        var self = this;

        self.$http
          .get(Router.route(API + '.solicitudes.solicitudes.show', {solicitudes: self.solicitud}))
          .then((res) => {
            self.buildTimeline(_.concat(res.data.derivaciones, res.data.seguimientos));
          }, (err) => console.error('Error: ', err));

        return self;
      },

      buildTimeline: function (concated) {
        var self = this;
        var datetime_arrays = [];
        self.$data.timeline = [];

        var concat_data = _
          .chain(concated)
          .each((item) => {
            var datetime    = _.isDefined(item.derivado_el) ? item.derivado_el:   item.generado_el;
            item.datetime   = datetime;
            item.date       = _.parseInt(moment(datetime).format('YMMDD')); // Parseado a entero para el agrupamiento y ordenamiento
            item.time       = moment(datetime).format('HH:mm');
            item.comentario = _.isDefined(item.derivado_el) ? item.observaciones: item.descripcion;
            item.tipo       = _.isDefined(item.derivado_el) ? 'Derivacion':       'Seguimiento';
          })
          .orderBy('datetime', 'desc')
          .groupBy('date')
          .value();

        _.each(concat_data, (item, index) => {
          datetime_arrays.push(index);
          self.timeline.push(item);
        });

        _.each(self.timeline, (item, index) => {
          self.timeline[index].unshift(datetime_arrays[index]);
        });

        self.timeline.reverse();

        return self;
      }
    },
  }

</script>
