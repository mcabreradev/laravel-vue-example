<template>
  <div>
    <input type="datetime" class="form-control" :name="name" v-model="value" required>
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
