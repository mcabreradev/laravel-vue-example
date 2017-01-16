<template>
  <div>
    <input type="text" v-datetimepicker class="form-control" v-model="value" :required="required">
  </div>
</template>
<script>
  export default {
    name: 'panal-datetime',
    props: {
      name: {
        type: String,
        required: false,
      },
      value: {
        type: String,
        default: () => '',
        required: false
      },
    },
  }

</script>
