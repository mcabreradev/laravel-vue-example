<form method="POST" action="{{ route('alertas::estados.store') }}">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">

  <div id="crear-estado-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Nuevo Estado</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="titulo" class="control-label">Título</label>
            <input id="titulo" name="titulo" type="text" class="form-control" required>
          </div>

          <div class="form-group">
            <label for="color" class="control-label">Color</label>
            <input id="color" name="color" type="color" class="form-control">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">
            <span class="fa fa-undo"></span>  Cancelar
          </button>
          <button type="submit" class="btn btn-success">
            <span class="fa fa-check"></span> Guardar
          </button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</form>
