<div class="row">

    <div class="col-xs-12 col-sm-4">
        <div class="form-group">
            <label for="tipo">Tipo</label>
            <select id="tipo" name="tipo" class="form-control">
                <option value="Factura"{{ (old('tipo', $pedido->tipo) === 'Factura' ? ' selected' : '') }}>Factura</option>
                <option value="Libre deuda"{{ (old('tipo', $pedido->tipo) === 'Libre deuda' ? ' selected' : '') }}>Libre deuda</option>
            </select>
        </div>
    </div>

    <div class="col-xs-12 col-sm-4">
        <div class="form-group">
            <label for="localidad">Localidad</label>
            <select id="localidad" name="localidad" class="form-control">
                <option value="Tolhuin"{{ (old('localidad', $pedido->localidad) === 'Tolhuin' ? ' selected' : '') }}>Tolhuin</option>
                <option value="Ushuaia"{{ ( (old('localidad', $pedido->localidad) === 'Ushuaia' || old('localidad', $pedido->localidad) === null) ? ' selected' : '') }}>Ushuaia</option>
            </select>
        </div>    
    </div>

    <div class="col-xs-12 col-sm-4">
        <div class="form-group">
            <label for="domicilio">Domicilio</label>
            <input id="domicilio" type="text" class="form-control" name="domicilio" value="{{ old('domicilio', $pedido->domicilio) }}">
        </div>    
    </div>

    <div class="col-xs-12 col-sm-4">
        <div class="form-group">
            <label for="unidad">Unidad</label>
            <input id="unidad" type="text" class="form-control" name="unidad" value="{{ old('unidad', $pedido->unidad) }}">
        </div>
    </div>

    <div class="col-xs-12 col-sm-4">
        <div class="form-group">
            <label for="macizo">Macizo</label>
            <input id="macizo" type="text" class="form-control" name="macizo" value="{{ old('macizo', $pedido->macizo) }}">
        </div>
    </div>

    <div class="col-xs-12 col-sm-4">
        <div class="form-group">
            <label for="parcela">Parcela</label>
            <input id="parcela" type="text" class="form-control" name="parcela" value="{{ old('parcela', $pedido->parcela) }}">
        </div>
    </div>

    <div class="col-xs-12">
        <div class="form-group">
            <label for="observaciones">Observaciones (período, modo de entrega, etc)</label>
            <textarea id="observaciones" name="observaciones" class="form-control" rows="5">{{ old('observaciones', $pedido->observaciones) }}</textarea>
        </div>
    </div>
</div>