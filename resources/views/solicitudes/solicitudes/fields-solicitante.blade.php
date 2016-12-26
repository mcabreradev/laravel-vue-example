{!! csrf_field() !!}

<div class="row">
  <div class="col-md-6 col-xs-12">
    <div class="form-group">
      <label for="apellido">Apellido</label>
      <input class="form-control" type="text" name="solicitante[apellido]" id="apellido" value="{{ old('apellido', $solicitud->apellido) }}">
    </div>
  </div>

  <div class="col-md-6 col-xs-12">
    <div class="form-group">
      <label for="nombre">Nombre</label>
      <input class="form-control" type="text" name="solicitante[nombre]" id="nombre" value="{{ old('nombre', $solicitud->nombre) }}">
    </div>
  </div>

  <div class="col-md-4 col-xs-12">
    <div class="form-group">
      <label for="documento">Documento</label>
      <input class="form-control" type="text" name="solicitante[documento]" id="documento" value="{{ old('documento', $solicitud->documento) }}">
    </div>
  </div>

  <div class="col-md-4 col-xs-12">
    <div class="form-group">
      <label for="telefono">Telefono</label>
      <input class="form-control" type="text" name="solicitante[telefono]" id="telefono" value="{{ old('telefono', $solicitud->telefono) }}">
    </div>
  </div>

  <div class="col-md-4 col-xs-12">
    <div class="form-group">
      <label for="celular">Celular</label>
      <input class="form-control" type="text" name="solicitante[celular]" id="celular" value="{{ old('celular', $solicitud->celular) }}">
    </div>
  </div>

  <div class="col-md-12 col-xs-12">
    <div class="form-group">
      <label for="email">Email</label>
      <input class="form-control" type="text" name="solicitante[email]" id="email" value="{{ old('email', $solicitud->email) }}">
    </div>
  </div>

</div>
