<template>
  <div>
    <h4>Reclamo: {{ solicitud }}</h4>
    <br>
    <ul class="timeline">
      <template v-for="(items, i) in timeline">
        <template v-for="(item, j) in items">
          <li v-if="j == 0" class="time-label"><span class="bg-blue">{{ item | dateOnly }}</span></li>
          <li v-else>
            <i v-if="item.tipo == 'Seguimiento'" class="fa fa-random bg-orange" :title="item.tipo"></i>
            <i v-else class="fa fa-repeat bg-green" :title="item.tipo"></i>
            <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> {{ item.datetime | hourSecondsOnly}} hs</span>
              <h3 class="timeline-header no-border"><b>{{ item.tipo }}:</b> #{{ item.id }}</h3>
              <div class="timeline-body">{{ item.comentario }}</div>
            </div>
          </li>
        </template>
      </template>
      <li><i class="fa fa-clock-o bg-gray"></i></li>
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
            this.derivaciones = res.body.data;
            self.getSeguimientos();
          }, (err) => console.error('Error: ', err));

        return self;
      },

      getSeguimientos: function () {
        var self = this;
        self.$http
          .get(Router.route(API + '.solicitudes.seguimientos.index'))
          .then((res) => {
            this.seguimientos = res.body.data
            self.buildTimeline();
          }, (err) => console.error('Error: ', err));

        return self;
      },

      buildTimeline: function () {
        var self = this;
        var datetime_arrays = [];
        var full_data = [];
        self.$data.timeline = [];

        var concat_data = _
          .chain(_.concat(self.derivaciones, self.seguimientos))
          .each((item) => {
            var datetime = _.isDefined(item.derivado_el) ? item.derivado_el : item.generado_el;
            item.datetime = datetime;
            item.date = _.parseInt(moment(datetime).format('YMMDD')); // Parseado a entero para el agrupamiento y ordenamiento
            item.time = moment(datetime).format('HH:mm');
            item.comentario = _.isDefined(item.derivado_el) ? item.observaciones : item.descripcion;
            item.tipo = _.isDefined(item.derivado_el) ? 'Derivacion' : 'Seguimiento';
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
