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

    <textarea v-if="field.type === 'textarea'"
      class="form-control"
      v-bind:id="field.id"
      v-model.trim="data[field.name]"
      v-bind:name="field.name"
      v-bind:placeholder="field.title"
      v-bind:required="field.required">
    </textarea>
  </div>
</template>

<script>
  export default {
    name: 's-inputs',
    props: ['field', 'data'],
  }
</script>
