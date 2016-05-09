<div class="row">

    <div class="col-xs-12 col-sm-4">
        <div class="form-group">
            <label for="dni">DNI</label>
            <input type="number" id="dni" name="dni" class="form-control" value="{{ old('dni', $usuario->dni) }}">
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

    <div class="col-xs-12 col-sm-4">
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" id="telefono" name="telefono" class="form-control" value="{{ old('telefono', $usuario->telefono) }}">
        </div>  
    </div>

    <div class="col-xs-12 col-sm-4">
        <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="text" id="email" name="email" class="form-control" value="{{ old('email', $usuario->email) }}">
        </div>  
    </div>
</div>
