<template>
  <div class="box box-default color-palette-box">

    <div class="box-header with-border">
      <h3 class="box-title">{{ title }}</h3>
    </div>

    <div class="box-body">
      <slot name="body"></slot>
    </div>

    <div class="box-footer">
      <slot name="footer"></slot>
    </div>

  </div>
</template>

<script>

  export default {
    name: 'panal-child',
    props: {
      title: {
        type: String,
        default: () => { return '' },
        required: true
      },
    },
  }

</script>
