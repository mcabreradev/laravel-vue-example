<template>
  <div>
    <form v-on:submit.prevent="submit(form.type)">
      <div class="form-group" v-for="field in fields" :key="field.id">
        <label v-bind:for="field">{{ field.title }}</label>
        <panal-inputs :field="field" :data="data"></panal-inputs>
      </div>

      <div class="pull-right">
        <a :href="form.routes.toIndex" class="btn btn-default">
          <span class="fa fa-undo"></span> Cancelar
        </a>
        <button class="btn btn-success" type="submit">
          <span class="fa fa-check"></span> {{ form.action }}
        </button>
      </div>
    </form>
  </div>
</template>

<script>

  export default {
    name: 'panal-form',

    props: {
      fields: {
        type: Array,
        default: () => { return [] },
        required: true
      },
      form: {
        type: Object,
        default: () => { return {} },
        required: true
      }
    },

    data: function() {
      var vm = this;
      return {
        data: vm.form.data,
      }
    },

    mounted(){

    },

    methods: {

      setObjectsFromFormFields: function() {
        _.each(this.fields, (val) => {
          this.data[val] = '';
        });

        return this;
      },

      submit: function(type) {
        type == 'create' ? this.create() : this.update();
      },

      create: function(){
        var vm = this;

        Events.$emit('indicator.show');

        this.$http.post(Router.route(vm.form.apiRoute + 'store'), this.data).then((res) => {
          Events.$emit('indicator.hide');
          if (res.ok){
            Redirect(vm.form.routes.toIndex);
          }
        }, (err) =>{
          console.error('Error: ', err);
        });

      },

      update: function(){
        var vm = this;

        Events.$emit('indicator.show');

        vm.$http.put(Router.route(vm.form.apiRoute + 'update', { [vm.form.model.plural] : vm.form.data.id}), vm.data).then((res) => {
          Events.$emit('indicator.hide');
          if (res.ok){
            Redirect(vm.form.routes.toIndex);
          }
        });
      }

    },

  }
</script>
