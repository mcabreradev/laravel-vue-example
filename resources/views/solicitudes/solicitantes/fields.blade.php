{!! csrf_field() !!}

<div class="row">
  <div class="col-md-6 col-xs-12">
    <div class="form-group">
      <label for="apellido">Apellido</label>
      <input class="form-control" type="text" name="apellido" id="apellido" value="{{ old('apellido', $data->apellido) }}" required>
    </div>
  </div>

  <div class="col-md-6 col-xs-12">
    <div class="form-group">
      <label for="nombre">Nombre</label>
      <input class="form-control" type="text" name="nombre" id="nombre" value="{{ old('nombre', $data->nombre) }}" required>
    </div>
  </div>

  <div class="col-md-4 col-xs-12">
    <div class="form-group">
      <label for="documento">Documento</label>
      <input class="form-control" type="text" name="documento" id="documento" value="{{ old('documento', $data->documento) }}" required>
    </div>
  </div>

  <div class="col-md-4 col-xs-12">
    <div class="form-group">
      <label for="telefono">Telefono</label>
      <input class="form-control" type="text" name="telefono" id="telefono" value="{{ old('telefono', $data->telefono) }}">
    </div>
  </div>

  <div class="col-md-4 col-xs-12">
    <div class="form-group">
      <label for="celular">Celular</label>
      <input class="form-control" type="text" name="celular" id="celular" value="{{ old('celular', $data->celular) }}">
    </div>
  </div>

  <div class="col-md-12 col-xs-12">
    <div class="form-group">
      <label for="email">Email</label>
      <input class="form-control" type="text" name="email" id="email" value="{{ old('email', $data->email) }}">
    </div>
  </div>

</div>
