<template>
  <div class="overlay" v-if="active">
    <i class="fa fa-refresh fa-spin"></i>
  </div>
</template>

<script>

  export default {

    name: 'panal-indicator',

     props: {
      isActive: {
          type: Boolean,
          default: false,
          required: false
      },
     },

    data: function() {
      return {
        active: this.isActive,
      }
    },

    mounted() {
      this.checkActive();
      this.checkEvents();
    },

    methods: {
      checkEvents: function(){
        Events.$on('indicator.show', this.show);
        Events.$on('indicator.hide', this.hide);
      },

      show: function () {
        this.active = true;
      },

      hide: function () {
        setTimeout(() => {
          this.active = false;
        }, 500);
      },

      checkActive: function() {
        if (this.isActive){
          this.hide();
        }
      },
    }
  }

</script>
