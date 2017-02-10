<input type="hidden" name="solicitante[id]" value="{{ old('id', !is_null($solicitud->solicitante) ? $solicitud->solicitante->id : null) }}">

<div class="row">

  <div class="col-md-6 col-xs-12">
    <div class="form-group">
      <label for="apellido">Apellido</label>
      <input class="form-control" type="text" name="solicitante[apellido]" id="apellido" value="{{ old('apellido', !is_null($solicitud->solicitante) ? $solicitud->solicitante->apellido : null) }}">
    </div>
  </div>

  <div class="col-md-6 col-xs-12">
    <div class="form-group">
      <label for="nombre">Nombre</label>
      <input class="form-control" type="text" name="solicitante[nombre]" id="nombre" value="{{ old('nombre', !is_null($solicitud->solicitante) ? $solicitud->solicitante->nombre : null) }}">
    </div>
  </div>

  <div class="col-md-4 col-xs-12">
    <div class="form-group">
      <label>¿Es titular?</label>
      <br>
      @if(!is_null($solicitud->solicitante) && $solicitud->solicitante->es_titular)
        <label class="radio-inline">
          <input type="radio" name="solicitante[es_titular]" value="1" checked> Si
        </label>
        <label class="radio-inline">
          <input type="radio" name="solicitante[es_titular]" value="0"> NO
        </label>
      @else
        <label class="radio-inline">
          <input type="radio" name="solicitante[es_titular]" value="1"> Si
        </label>
        <label class="radio-inline">
          <input type="radio" name="solicitante[es_titular]" value="0" checked> NO
        </label>
      @endif
    </div>
  </div>

  <div class="col-md-4 col-xs-12">
    <div class="form-group">
      <label for="telefono">Teléfono</label>
      <input class="form-control" type="text" name="solicitante[telefono]" id="telefono" value="{{ old('telefono', !is_null($solicitud->solicitante) ? $solicitud->solicitante->telefono : null) }}">
    </div>
  </div>

  <div class="col-md-4 col-xs-12">
    <div class="form-group">
      <label for="celular">Celular</label>
      <input class="form-control" type="text" name="solicitante[celular]" id="celular" value="{{ old('celular', !is_null($solicitud->solicitante) ? $solicitud->solicitante->celular : null) }}">
    </div>
  </div>

  <div class="col-md-12 col-xs-12">
    <div class="form-group">
      <label for="email">Email</label>
      <input class="form-control" type="text" name="solicitante[email]" id="email" value="{{ old('email', !is_null($solicitud->solicitante) ? $solicitud->solicitante->email : null) }}">
    </div>
  </div>

</div>
