<input type="hidden" name="user_id" value="{{$user->id}}">

<panal-box-slot title="Datos Generales">
  <div slot="body">
    <div class="row">
      <div class="col-md-4 col-xs-12">
        <div class="form-group">
          <label for="creado_el">Fecha</label>
          <input type="datetime" class="form-control" name="creado_el" required
            value="{{ old('creado_el', $solicitud->creado_el) }}">
        </div>
      </div>

      <div class="col-md-4 col-xs-12">
        <div class="form-group">
          <label for="tipo_id">Tipo</label>
          <select class="form-control" id="tipo_id" name="tipo_id" style="width: 100%" required>
            @foreach($tipos as $tipo)
              @if( collect($solicitud->tipo)->contains($tipo->id))
                <option value="{{ $tipo->id }}" data-checklist="{{$tipo->checklist ?: '[]'}}" selected>{{ $tipo->nombre }}</option>
              @else
                <option value="{{ $tipo->id }}" data-checklist="{{$tipo->checklist ?: '[]'}}">{{ $tipo->nombre }}</option>
              @endif
            @endforeach
          </select>
        </div>
      </div>

      <div class="col-md-4 col-xs-12">
        <div class="form-group">
          <label for="reclamo_anterior">Nro de reclamo anterior</label>
          <input type="number" class="form-control" name="reclamo_anterior" value="{{ old('reclamo_anterior', $solicitud->reclamo_anterior) }}">
        </div>
      </div>

      <div class="col-xs-12">
        <div class="form-group">
          <label for="descripcion">Descripción</label>
          <textarea class="form-control" id="descripcion" name="descripcion" rows="5">{{ old('descripcion', $solicitud->descripcion) }}</textarea>
        </div>
      </div>

    </div>
  </div>
  <panal-indicator></panal-indicator>
</panal-box-slot>

<panal-box-slot title="Datos específicos del tipo de reclamo">
  <div slot="body">
    <dposs-checklist-solicitudes :checklist="{{$solicitud->checklist ?: '[]'}}"></dposs-checklist-solicitudes>
  </div>
  <panal-indicator></panal-indicator>
</panal-box-slot>

@section('body-scripts')
@parent

<script>
  ;(function($){
    'use strict';

    $('#tipo_id').on('change', function(){
      appVue.$emit('change-checklist-solicitudes', $('#tipo_id').find('option:selected').data('checklist'));
    });

    @if(!$solicitud->id)
    $('#tipo_id').change();
    @endif
  })(window.jQuery, window.swal);
</script>
@endsection

