<div class="row">

    <div class="col-xs-12 col-sm-4">
        <div class="form-group">
            <label for="origen">Origen</label>
            <select id="origen" name="origen" class="form-control">
                @foreach($pedido::$ORIGENES as $claveOrigen => $valorOrigen)
                    <option value="{{ $claveOrigen }}" {{ (old('origen', $pedido->origen) === $claveOrigen ? 'selected' : '') }}>{{ $valorOrigen }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-xs-12 col-sm-4">
        <div class="form-group">
            <label for="tipo">Tipo</label>
            <select id="tipo" name="tipo" class="form-control">
                @foreach($pedido::$TIPOS as $claveTipo => $valorTipo)
                    <option value="{{ $claveTipo }}" {{ (old('tipo', $pedido->tipo) === $claveTipo ? 'selected' : '') }}>{{ $valorTipo }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-xs-12 col-sm-4">
        <div class="form-group">
            <label for="metodo_entrega">Forma de entrega</label>
            <select id="metodo_entrega" name="metodo_entrega" class="form-control">
                @foreach($pedido::$METODOS_ENTREGA as $claveMetodo => $valorMetodo)
                    <option value="{{ $claveMetodo }}" {{ (old('metodo_entrega', $pedido->metodo_entrega) === $claveMetodo ? 'selected' : '') }}>{{ $valorMetodo }}</option>
                @endforeach
            </select>
        </div>
    </div>


    <div class="col-xs-12 col-sm-4">
        <div class="form-group">
            <label for="localidad">Localidad</label>
            <select id="localidad" name="localidad" class="form-control">
                @foreach($pedido::$LOCALIDADES as $claveLocalidad => $valorLocalidad)
                    <option value="{{ $claveLocalidad }}" {{ ( (old('localidad', $pedido->localidad) === 'ushuaia' || old('localidad', $pedido->localidad) === null) ? 'selected' : '') }}>{{ $valorLocalidad }}</option>
                @endforeach
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
            <label for="nomenclatura">Nomenclatura catastral (sección, unidad, macizo, parcela)</label>
            <input id="nomenclatura" type="text" class="form-control" name="nomenclatura" value="{{ old('nomenclatura', $pedido->nomenclatura) }}">
        </div>
    </div>

    <!-- autoguiado -->
    <div class="col-xs-12 col-sm-4">
        <div class="form-group">
            <label for="prioritario">¿Es prioritario este pedido?</label>
            
            <!-- if not checked this value is submitted -->
            <input type="hidden" name="prioritario" value="0">
            
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="prioritario" name="prioritario" value="1" {{ old('description', $pedido->prioritario) ? ('checked') : ''}}> Si, es prioritario
                </label>
            </div>
        </div>
    </div>

    <div class="col-xs-12">
        <div class="form-group">
            <label for="observaciones">Observaciones (período, etc)</label>
            <textarea id="observaciones" name="observaciones" class="form-control" rows="5">{{ old('observaciones', $pedido->observaciones) }}</textarea>
        </div>
    </div>
</div>