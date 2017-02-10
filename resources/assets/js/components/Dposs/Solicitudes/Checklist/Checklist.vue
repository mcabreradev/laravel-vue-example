<template>
  <div class="row">
    <div class="col-xs-12" v-for="check in checklistMutable" v-if="checklistMutable.length > 0">

      <div class="form-group" v-if="check.type === 'boolean'">
        <label>{{check.label}}</label>
        <br>
        <label class="radio-inline">
          <input type="radio" :value="true" v-model="check.value"> Si
        </label>
        <label class="radio-inline">
          <input type="radio" value="false" v-model="check.value"> NO
        </label>
      </div>

      <div class="form-group" v-if="check.type === 'text'">
        <label>{{check.label}}</label>
        <input class="form-control" type="text" v-model="check.value">
      </div>

      <div class="form-group" v-if="check.type === 'textarea'">
        <label>{{check.label}}</label>
        <textarea class="form-control" rows="3" v-model="check.value"></textarea>
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
