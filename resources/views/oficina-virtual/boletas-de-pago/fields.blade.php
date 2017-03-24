<div class="col-xs-12 col-md-7">

    <form id="form" method="POST" action="{{ route('oficina-virtual::boletas-de-pago-query') }}">
      {!! csrf_field() !!}
      <div class="form-group">
        <label>Direccion</label>
        <select class="form-control" id="conexiones" name="tipo_busqueda">
          <option value="">Seleccione</option>
          @foreach($conexiones as $conexion)
            <option value="{{ $conexion->tipo_busqueda }}">{{ $conexion->domicilio_completo }}</option>
          @endforeach
          <option value="otros">Otros</option>
        </select>
      </div>

    </form>

</div>

