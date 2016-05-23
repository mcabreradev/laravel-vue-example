<div class="row">
    <div class="col-xs-12 col-sm-6">
        <div class="form-group">
            <label for="solicitante_apellido">Apellido</label>
            <input type="text" id="solicitante_apellido" name="solicitante_apellido" class="form-control" value="{{ old('solicitante_apellido', $pedido->solicitante_apellido) }}">
        </div>
    </div>

    <div class="col-xs-12 col-sm-6">
        <div class="form-group">
            <label for="solicitante_nombre">Nombre</label>
            <input type="text" id="solicitante_nombre" name="solicitante_nombre" class="form-control" value="{{ old('solicitante_nombre', $pedido->solicitante_nombre) }}">
        </div>
    </div>

    <div class="col-xs-12 col-sm-6">
        <div class="form-group">
            <label for="solicitante_telefono">Teléfono</label>
            <input type="text" id="solicitante_telefono" name="solicitante_telefono" class="form-control" value="{{ old('solicitante_telefono', $pedido->solicitante_telefono) }}">
        </div>
    </div>

    <div class="col-xs-12 col-sm-6">
        <div class="form-group">
            <label for="solicitante_email">Correo electrónico</label>
            <input type="text" id="solicitante_email" name="solicitante_email" class="form-control" value="{{ old('solicitante_email', $pedido->solicitante_email) }}">
        </div>
    </div>
</div>