<template>
  <span role="button" data-toggle="tooltip" data-container="body" :data-placement="position" :title="title">
    <slot></slot>
  </span>
</template>
<script>
  export default {
    name: 'panal-tooltip',
    props: {
      title: {
        type: String,
        default: () => '',
        required: true
      },
      position: {
        type: String,
        default: () => 'top',
        required: false
      },
    }
  }

</script>
