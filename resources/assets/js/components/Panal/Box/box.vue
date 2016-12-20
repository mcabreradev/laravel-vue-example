<template>
  <div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box"> <!-- BOX -->

          <div class="box-header with-border">
            <h3 class="box-title">{{ form.action }} <span class="text-capital">{{ model.singular }}</span></h3>
          </div>

          <div class="box-body">
            <panal-form :fields="fields" :form="form"></panal-form>
          </div>

          <panal-indicator :is-active="true"></panal-indicator>

        </div> <!-- BOX end -->
      </div>
    </div>
  </div>
</template>

<script>

  export default {
    name: 'p-box',

    props: {
      type: {
        type: String,
        default: () => { return '' },
        required: true
      },
      fields: {
        type: Array,
        default: () => { return [] },
        required: true
      },
      model: {
        type: Object,
        default: () => {
          return { singular: '', plural: '' };
        },
      },
      url: {
        type: Object,
        default: () => { return {} },
        required: true
      },
      item: {
        type: Object,
        default: () => { return {} },
        required: false
      }
    },

    data: function() {
      var vm = this;
      return {
        form: {
          apiRoute: _.join([API, vm.url.simple, ''], '.'),
          model: vm.model,
          type: vm.type,
          action: vm.type == 'create' ? 'Agregar' : 'Editar',
          routes:{
            toIndex: Router.route(vm.url.doble) ,
          },
          data: vm.item,
        },
      }
    },

    mounted(){

    },

  }
</script>
