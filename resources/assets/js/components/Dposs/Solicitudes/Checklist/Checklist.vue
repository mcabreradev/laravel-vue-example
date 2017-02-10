<template>
  <div class="row">
    <div class="col-xs-12" v-for="check in checklistMutable" v-if="checklistMutable.length > 0">

      <div class="checkbox" v-if="check.type === 'checkbox'">
        <label>
          <input class="pull-right" type="checkbox" v-model="check.value"> {{check.label}}
        </label>
      </div>

      <div class="form-group" v-if="check.type === 'text'">
        <label>{{check.label}}</label>
        <input class="form-control" type="text" v-model="check.value">
      </div>

      <div class="form-group" v-if="check.type === 'number'">
        <label>{{check.label}}</label>
        <input class="form-control" type="number" v-model="check.value">
      </div>

      <input type="hidden" name="checklist" :value="JSON.stringify(checklistMutable)">
    </div>

    <div class="col-xs-12" v-if="checklistMutable === 0">
      <p>Sin datos específicos</p>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'dposs-checklist-solicitudes',
    props: {
      checklist: {
        type: Array,
        required: true
      }
    },
    created() {
      this.$root.$on('change-checklist-solicitudes', this.changeChecklistSolicitudes);
    },
    beforeDestroy() {
      this.$off('change-checklist-solicitudes', this.changeChecklistSolicitudes);
    },
    data() {
      return {
        checklistMutable: this.checklist
      }
    },
    methods: {
      changeChecklistSolicitudes(newChecklist) {
        console.log(newChecklist);
        this.checklistMutable = newChecklist;
      }
    }
  };
</script>
