@extends('layouts.app')

@section('content-header')
  Cuentas vinculadas <small>Oficina Virtual</small>
@endsection

@section('content-breadcrumb')
<li><a href="{{ route('home') }}">Inicio</a></li>
<li><a href="{{ route('oficina-virtual::conexiones.vinculadas') }}">Cuentas vinculadas</a></li>
@endsection


@section('content')

<div class="row">
  <div class="col-xs-12">

    @include('flash::message')

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Tus cuentas vinculadas</h3>
      </div>
      <div class="box-body">

        <div class="row mb-25">
          <div class="col-xs-12">
            <div class="pull-right">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#vincular-cuenta">
                <i class="fa fa-plus"></i> Vincular otra cuenta
              </button>
            </div>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-striped table-bordered" id="tabla-cuentas">
            <thead>
              <tr>
                <th>Domicilio</th>
                <th>Expediente</th>
                <th>Unidad</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($conexiones as $conexion)
              <tr>
                <td>{{ $conexion->domicilio }}</td>
                <td>{{ $conexion->expediente }}</td>
                <td>{{ $conexion->unidad }}</td>
                <td>
                  <form action="{{route('oficina-virtual::conexiones.desvincular', $conexion->id)}}" method="POST">
                    {!! csrf_field() !!}
                    {{ method_field('DELETE') }}

                    <button type="submit" class='btn btn-danger desvincular-btn' data-toggle="tooltip" data-placement="top" title="Desvincular cuenta">
                      <span class="fa fa-times"></span>
                    </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


<form method="POST" action="{{ route('oficina-virtual::conexiones.vincular-usuario') }}">
  {!! csrf_field() !!}

  <div id="vincular-cuenta" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Vincular cuenta</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="nro_factura">
                Número de factura <span class="text-danger">*</span> <span class="field-help label label-warning"><a href="//dposs.gob.ar/wordpress/wp-content/uploads/2017/03/factura-ayuda-liquidacion-sp.jpg" target="_blank" rel="noopener noreferrer">Necesita ayuda?</a></span>
              </label>
              <input type="number" class="form-control" name="nro_factura" id="nro_factura" value="{{ old('nro_factura') }}" required>
            </div>

            <div class="form-group">
              <label for="periodo_factura">
                Período de factura <span class="text-danger">*</span> <span class="field-help label label-warning"><a href="//dposs.gob.ar/wordpress/wp-content/uploads/2017/03/factura-ayuda-periodo.jpg" target="_blank" rel="noopener noreferrer">Necesita ayuda?</a></span>
              </label>
              <input type="text" class="form-control" name="periodo_factura" id="periodo_factura"
                value="{{ old('periodo_factura') }}" required>
            </div>

            <div class="form-group">
              <label for="monto_factura">
                Monto de factura <span class="text-danger">*</span> <span class="field-help label label-warning"><a href="//dposs.gob.ar/wordpress/wp-content/uploads/2017/03/factura-ayuda-monto.jpg" target="_blank" rel="noopener noreferrer">Necesita ayuda?</a></span>
              </label>
              <input type="text" class="form-control" name="monto_factura" id="monto_factura"
                value="{{ old('monto_factura') }}" required>
            </div>

            <div class="form-group">
              <label for="expediente">
                Expediente <span class="text-danger">*</span> <span class="field-help label label-warning"><a href="//dposs.gob.ar/wordpress/wp-content/uploads/2017/03/factura-ayuda-expediente.jpg" target="_blank" rel="noopener noreferrer">Necesita ayuda?</a></span>
              </label>
              <input type="number" class="form-control" name="expediente" id="expediente" value="{{ old('expediente') }}" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Vincular</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</form>


@endsection

@push('body-scripts')
  <script type="text/javascript">
    (function($, vanillaTextMask, textMaskAddons){
      var periodoMask = [/[0-9]/, /[0-9]/, '/', /[0-9]/, /[0-9]/, /[0-9]/, /[0-9]/];
      var periodoInput = document.getElementById('periodo_factura');

      vanillaTextMask.maskInput({
        inputElement: periodoInput,
        mask: periodoMask
      });

      var montoMask = textMaskAddons.createNumberMask({
        prefix: '',
        includeThousandsSeparator:false,
        allowDecimal:true,
        decimalSymbol:',',
        requireDecimal:true
      });
      var montoInput = document.getElementById('monto_factura');

      vanillaTextMask.maskInput({
        inputElement: montoInput,
        mask: montoMask
      });

      $('#tabla-cuentas').on('click', '.desvincular-btn', function(event){
        event.stopPropagation();
        event.preventDefault();
        var $form = $(this).parent('form');

        console.log($form);

        swal({
          title: "¿Desvincular cuenta?",
          text: "Si desvinculas esta cuenta ya no podrás ver su información",
          type: "warning",
          showCancelButton: true,
          confirmCancelText: 'Mejor no',
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Si, desvincular",
          closeOnConfirm: false,
          showLoaderOnConfirm: true
        },
        function(){
          $form.submit();
        });
      });

    })(window.jQuery, window.vanillaTextMask, window.textMaskAddons);
  </script>
@endpush
