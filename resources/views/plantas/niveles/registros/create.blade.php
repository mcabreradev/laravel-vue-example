<form method="POST" action="{{ route('plantas.niveles.registros.store') }}">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">

  <div id="crear-registro-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Nuevo registro</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="fecha-registro" class="control-label">Fecha de medición</label>
            <input id="fecha-registro" required name="registrado_el" type="datetime"
              class="form-control" value="{{ date('Y-m-d H:m:00') }}">
          </div>

          <div class="form-group">
            <label for="nivel-select" class="control-label">Elija un nivel</label>
            <select id="nivel-select" required name="nivel" class="form-control">
              @foreach($niveles as $nivel)
                <option value="{{ $nivel->id }}">{{ $nivel->titulo }}</option>
              @endforeach
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">
            <span class="fa fa-undo"></span> Cancelar
          </button>
          <button type="submit" class="btn btn-success">
            <span class="fa fa-check"></span> Guardar
          </button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</form>
