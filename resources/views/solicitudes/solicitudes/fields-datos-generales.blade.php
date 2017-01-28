{!! csrf_field() !!}

<div class="row">
  <div class="col-md-6 col-xs-12">
    <div class="form-group">
      <label for="creado_el">Fecha</label>
      <input
        type="datetime"
        class="form-control"
        name="creado_el"
        value="{{ old('creado_el', $solicitud->creado_el) }}">
    </div>
  </div>

  <div class="col-md-6 col-xs-12">
    <div class="form-group">
      <label for="tipo_id">Tipo</label>
      <select class="form-control" id="tipo_id" name="tipo_id" style="width: 100%">
        <option value="">Selecione</option>
        @foreach($tipos as $tipo)
          @if( collect($solicitud->tipo)->contains($tipo->id))
            <option value="{{ $tipo->id }}" selected>{{ $tipo->nombre }}</option>
          @else
            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
          @endif
        @endforeach
      </select>
    </div>
  </div>

  <div class="col-xs-12">
    <div class="form-group">
      <label for="descripcion">Descripción</label>
      <textarea class="form-control" id="descripcion" name="descripcion" required rows="5">{{ old('descripcion', $solicitud->descripcion) }}</textarea>
    </div>
  </div>

  <div class="col-xs-12">
    <div class="form-group">
      <label for="observaciones">Observaciones</label>
      <textarea class="form-control" id="observaciones" name="observaciones" rows="5">{{ old('observaciones', $solicitud->observaciones) }}</textarea>
    </div>
  </div>

  <div class="col-md-4 col-xs-12">
    <div class="form-group">
      <label for="estado_id">Estado</label>
      <select class="form-control" id="estado_id" name="estado_id" style="width: 100%">
        <option value="">Selecione</option>
        @foreach($estados as $estado)
          @if( collect($solicitud->estado)->contains($estado->id))
            <option value="{{ $estado->id }}" selected>{{ $estado->nombre }}</option>
          @else
            <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
          @endif
        @endforeach
      </select>
    </div>
  </div>

  <div class="col-md-4 col-xs-12">
    <div class="form-group">
      <label for="prioridad_id">Prioridad</label>
      <select class="form-control" id="prioridad_id" name="prioridad_id" style="width: 100%">
        <option value="">Selecione</option>
        @foreach($prioridades as $prioridad)
          @if( collect($solicitud->prioridad)->contains($prioridad->id))
            <option value="{{ $prioridad->id }}" selected>{{ $prioridad->nombre }}</option>
          @else
            <option value="{{ $prioridad->id }}">{{ $prioridad->nombre }}</option>
          @endif
        @endforeach
      </select>
    </div>
  </div>

  <div class="col-md-4 col-xs-12">
    <div class="form-group">
      <label for="origen_id">Orígen</label>
      <select class="form-control" id="origen_id" name="origen_id" style="width: 100%">
        <option value="">Selecione</option>
        @foreach($origenes as $origen)
          @if(collect($solicitud->origen)->contains($origen->id))
            <option value="{{ $origen->id }}" selected>{{ $origen->nombre }}</option>
          @else
            <option value="{{ $origen->id }}">{{ $origen->nombre }}</option>
          @endif
        @endforeach
      </select>
    </div>
  </div>

</div>
