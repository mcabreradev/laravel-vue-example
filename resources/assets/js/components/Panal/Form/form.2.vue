<template>
  <div>
    <form>
      <slot name="fields"></slot>
    </form>
  </div>
</template>

<script>

  export default {
    name: 'panal-form-2',

    props: {

    },

    data: function() {
      var vm = this;

      return {
        data: {},
      }
    },

    mounted(){

    },

    methods: {

    },

  }
</script>
