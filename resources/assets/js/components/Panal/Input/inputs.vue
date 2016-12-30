<template>
  <div>
    <input v-if="field.type === 'text'"
    class="form-control"
    type="text"
    v-bind:id="field.id"
    v-model.trim="data[field.name]"
    v-bind:name="field.name"
    v-bind:placeholder="field.title"
    v-bind:required="field.required">

    <input v-if="field.type === 'color'"
      class="form-control"
      type="color"
      v-bind:id="field.id"
      v-model.trim="data[field.name]"
      v-bind:name="field.name"
      v-bind:placeholder="field.title"
      v-bind:required="field.required">

    <panal-calendar
      v-if="field.type === 'calendar'"
      :name="name"
      :value="value"
      :placeholder="title"
    ></panal-calendar>

    <textarea v-if="field.type === 'textarea'"
      class="form-control"
      v-bind:id="field.id"
      v-model.trim="data[field.name]"
      v-bind:name="field.name"
      v-bind:placeholder="field.title"
      v-bind:required="field.required">
    </textarea>

    <input v-if="field.type === 'hidden'"
      type="hidden"
      v-model="data[field.name]"
      v-bind:name="field.name">

  </div>
</template>

<script>
  export default {
    name: 'panal-inputs',
    props: ['field', 'data'],
    data: function(){
      return {
        value: this.isUndefinedOrDefined(this.data[this.field.name]),
        name: this.isUndefinedOrDefined(this.field.name),
        title: this.isUndefinedOrDefined(this.field.title),
      }
    },
    methods:{
      isUndefinedOrDefined: function (thing){
        return typeof thing == 'undefined'  ? '' : thing
      }
    },
    mounted() {

    },
  }
</script>
