{!! csrf_field() !!}

<div class="row">
  <div class="col-md-6 col-xs-12">
    <div class="form-group">
      <label for="creado_el">Fecha</label>
      <panal-calendar
        name="creado_el"
        value="{{ old('creado_el', $solicitud->creado_el) }}">
      </panal-calendar>
    </div>
  </div>

  <div class="col-md-6 col-xs-12">
    <div class="form-group">
      <label for="tipo">Tipo</label>
      <select class="form-control" id="tipo" name="tipo" style="width: 100%">
        <option value="">Selecione</option>
        @foreach($tipos as $tipo)
          @if( !is_null($solicitud->tipo) && $solicitud->tipo->contains($tipo->id))
            <option value="{{ $tipo->id }}" selected>{{ $tipo->nombre }}</option>
          @else
            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
          @endif
        @endforeach
      </select>
    </div>
  </div>

  <div class="col-md-12 col-xs-12">
    <div class="form-group">
      <label for="descripcion">Descripción</label>
      <textarea class="form-control" id="descripcion" name="descripcion" required>{{ old('descripcion', $solicitud->descripcion) }}</textarea>
    </div>
  </div>

  <div class="col-md-4 col-xs-12">
    <div class="form-group">
      <label for="estado">Estado</label>
      <select class="form-control" id="estado" name="estado" style="width: 100%">
        <option value="">Selecione</option>
        @foreach($estados as $estado)
          @if( !is_null($solicitud->estado) && $solicitud->estado->contains($estado->id))
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
      <label for="prioridad">Prioridad</label>
      <select class="form-control" id="prioridad" name="prioridad" style="width: 100%">
        <option value="">Selecione</option>
        @foreach($prioridades as $prioridad)
          @if( !is_null($solicitud->prioridad) && $solicitud->prioridad->contains($prioridad->id))
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
      <label for="origen">Origen</label>
      <select class="form-control" id="origen" name="origen" style="width: 100%">
        <option value="">Selecione</option>
        @foreach($origenes as $origen)
          @if( !is_null($solicitud->origen) && $solicitud->origen->contains($origen->id))
            <option value="{{ $origen->id }}" selected>{{ $origen->nombre }}</option>
          @else
            <option value="{{ $origen->id }}">{{ $origen->nombre }}</option>
          @endif
        @endforeach
      </select>
    </div>
  </div>

</div>
