<div class="row">

    @if(isset($pedido) && $pedido->id)
        <div class="col-xs-12">
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" class="form-control" rows="3" disabled>{{ $pedido->descripcion }}</textarea>
            </div>
        </div>
    @endif

    <div class="col-xs-12 col-sm-4">
        <div class="form-group">
            <label for="localidad">Localidad</label>
            <select id="localidad" name="localidad" class="form-control">
                @foreach($pedido::$LOCALIDADES as $claveLocalidad => $valorLocalidad)
                    @if((old('localidad', $pedido->localidad) === $claveLocalidad) || ($claveLocalidad === 'ushuaia' && old('localidad', $pedido->localidad) === null))
                        <option value="{{ $claveLocalidad }}" selected>{{ $valorLocalidad }}</option>
                    @else
                        <option value="{{ $claveLocalidad }}">{{ $valorLocalidad }}</option>
                    @endif
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
            <label for="nomenclatura">Nomenclatura catastral</label>
            <input id="nomenclatura" type="text" class="form-control" name="nomenclatura" value="{{ old('nomenclatura', $pedido->nomenclatura) }}">
        </div>
    </div>

    <div class="col-xs-12 col-sm-4">
        <div class="form-group">
            <label for="origen">Origen</label>
            <select id="origen" name="origen" class="form-control">
                @foreach($pedido::$ORIGENES as $claveOrigen => $valorOrigen)
                    <option value="{{ $claveOrigen }}" {{ ( ((old('origen', $pedido->origen) === $claveOrigen) || (old('origen', $pedido->origen))) ? 'selected' : '') }}>{{ $valorOrigen }}</option>
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
                    @if((old('metodo_entrega', $pedido->metodo_entrega) === $claveMetodo) || ($claveMetodo === 'email' && old('metodo_entrega', $pedido->metodo_entrega) === null))
                        <option value="{{ $claveMetodo }}" selected>{{ $valorMetodo }}</option>
                    @else
                        <option value="{{ $claveMetodo }}">{{ $valorMetodo }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-xs-12 col-sm-4">
        <div class="form-group">
            <label for="estado">Estado del pedido</label>
            <select id="estado" name="estado" class="form-control">
                @if($pedido->id == 0)
                    <option value="pendiente">Pendiente</option>
                @else
                    @foreach($pedido::$ESTADOS as $claveEstado => $valorEstado)
                        @if(!($claveEstado === 'cancelado' && $pedido->estado !== 'cancelado'))
                            <option value="{{ $claveEstado }}" {{ (old('estado', $pedido->estado) === $claveEstado ? 'selected' : '') }}>{{ $valorEstado }}</option>
                        @endif
                    @endforeach
                @endif
            </select>
        </div>
    </div>

    <div class="col-xs-12 col-sm-4">
        <div class="form-group">
            <label for="prioritario">¿Es prioritario este pedido?</label>
            
            <!-- if not checked this value is submitted -->
            <input type="hidden" name="prioritario" value="0">
            
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="prioritario" name="prioritario" value="1" {{ old('prioritario', $pedido->prioritario) ? 'checked' : ''}}> Si, es prioritario
                </label>
            </div>
        </div>
    </div>

    @if((!isset($pedido)) || ($pedido->id == 0))
        <div class="col-xs-12 col-sm-4">
            <div class="form-group">
                <label for="periodos">Periodo requerido</label>
                <select id="periodos" name="periodos" class="form-control">
                    <option value="Ninguno" {{ (old('periodos') === 'Ninguno' ? 'selected' : '') }}>Ninguno</option>
                    <option value="Pagos adeudados" {{ (old('periodos') === 'Pagos adeudados' ? 'selected' : '') }}>Pagos adeudados</option>
                    <option value="Último perído facturado" {{ (old('periodos') === 'Último perído facturado' ? 'selected' : '') }}>Último perído facturado</option>
                    <option value="Últimos seis meses" {{ (old('periodos') === 'Últimos seis meses' ? 'selected' : '') }}>Últimos seis meses</option>
                </select>
            </div>
        </div>
    @endif

    <div class="col-xs-12">
        <div class="form-group">
            <label for="observaciones">Observaciones (período, etc)</label>
            <textarea id="observaciones" name="observaciones" class="form-control" rows="5">{{ old('observaciones', $pedido->observaciones) }}</textarea>
        </div>
    </div>
</div>