<div class="row">
    <div class="col-xs-12 col-sm-4">
        <div class="form-group">
            <label for="documento">DNI o CUIT</label>
            <input type="number" id="documento" name="documento" class="form-control" value="{{ old('documento', $usuario->documento) }}">
        </div>
    </div>

    <div class="col-xs-12 col-sm-4">
        <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" id="apellido" name="apellido" class="form-control" value="{{ old('apellido', $usuario->apellido) }}">
        </div>
    </div>

    <div class="col-xs-12 col-sm-4">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre', $usuario->nombre) }}">
        </div>
    </div>
</div>
