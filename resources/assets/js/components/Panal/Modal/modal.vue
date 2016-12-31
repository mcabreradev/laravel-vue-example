<template>
  <div class="modal fade" tabindex="-1" role="dialog" :id="id">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">{{ title }}</span>
          </h4>
        </div>
        <div class="modal-body panal-modal">
          <slot></slot>
        </div>
        <div class="modal-footer">
          <a type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
          <a type="button" class="btn btn-primary" data-dismiss="modal">{{ type }}</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</template>
<script>
  export default {
    name: 'panal-modal',

    props: {
      title: {
        type: String,
        default: () => {
          return ''
        },
        required: true
      },
      type: {
        type: String,
        default: () => {
          return 'Aceptar'
        },
        required: false
      },
      id: {
        type: String,
        default: () => {
          return 'modalId-' + _.random(9999999, 99999999)
        },
        required: false
      },
    },
  }

</script>
<style lang="sass" scoped>
  .modal-header {
    border-bottom-color: #f4f4f4;
    background-color: #3c8dbc;
    color: #fff;
    margin-bottom: 10px;
  }

  .close {
    color: #fff;
    opacity: 0.7;
  }

  .close:hover {
    opacity: 0.9;
  }
</style>
