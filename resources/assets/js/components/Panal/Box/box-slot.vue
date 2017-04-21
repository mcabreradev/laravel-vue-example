<template>
  <div class="box box-primary color-palette-box">

    <div class="box-header with-border" v-if="hasTitle">
      <h3 class="box-title">{{ title }}</h3>
      <button v-if="printable" type="button" onclick="window.print();" class="hidden-print btn btn-default pull-right"><i class="fa fa-print"></i> Imprimir</button>
    </div>

    <div class="box-body" v-if="hasBody">
      <slot name="body"></slot>
    </div>

    <div class="box-footer" v-if="hasFooter">
      <slot name="footer"></slot>
    </div>

    <panal-indicator/>

  </div>
</template>

<script>
  export default {
    name: 'panal-box-slot',
    props: {
      title: {
        type: String,
        default: () => '',
        required: false
      },
      printable: {
        type: Boolean,
        default: false,
        required: false
      },
    },
    data: function() {
      return {
        hasTitle: this.title !== '' ? true : false,
        hasBody: !_.isUndefined(this.$slots['body']) ? true : false,
        hasFooter: !_.isUndefined(this.$slots['footer']) ? true : false,
      }
    }
  }
</script>
