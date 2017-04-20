@extends('layouts.base')

@section('body-attributes')
class="hold-transition register-page"
@endsection

@section('body-content')

<div class="container">
  @include('auth.encabezado')

  <div class="row">
    <div class="col-xs-12">
      @if (count($errors) > 0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
    </div>
  </div>

  <form role="form" method="POST" action="{{ route('auth::register') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="row">
      <div class="col-xs-12 col-sm-6">
        <h4 class="well">Datos de tu cuenta</h4>

        <div class="form-group">
          <label for="name">Nombre <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
          <label for="email">E-mail <span class="text-danger">*</span></label>
          <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
          <label for="password">Contraseña <span class="text-danger">*</span></label>
          <input type="password" class="form-control" name="password" id="password" required>
        </div>

        <div class="form-group">
          <label for="password_confirmation">Repetir contraseña <span class="text-danger">*</span></label>
          <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
        </div>

        <div class="form-group">
          <label for="telefono">Teléfono celular</label>
          <input type="number" class="form-control" name="telefono" id="telefono" value="{{ old('telefono') }}">
        </div>
      </div> <!-- /.col-xs-12 col-sm-6 -->

      <div class="col-xs-12 col-sm-6">
        <h4 class="well">Datos de alguna factura</h4>

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

        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" id="terminos_y_condiciones" name="terminos_y_condiciones" value="1"> Al marcar esta opción acepto los <a href="http://dposs.gob.ar/#!/pagina/terminos-y-condiciones-de-la-oficina-virtual" target="_blank" rel="noopener noreferrer">términos y condiciones</a>
            </label>
          </div>
        </div>
      </div> <!-- /.col-xs-12 col-sm-6 -->


    </div> <!-- /.row -->

    <div class="row">
      <div class="col-xs-12 col-sm-6 col-sm-offset-6">
        <button type="submit" class="btn btn-success btn-lg btn-block">
          <i class="fa fa-btn fa-lock"></i> Registrarse
        </button>
      </div>
    </div>
  </form>


</div>

@endsection

@push('body-scripts')
  <script src="{{ asset('/compiled/vendors/text-mask/vanilla/vanillaTextMask.js') }}"></script>
  <script src="{{ asset('/compiled/vendors/text-mask/addons/textMaskAddons.js') }}"></script>
  <script type="text/javascript">
    (function(vanillaTextMask, textMaskAddons){
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

      // vanillaTextMask.maskInput({
      //   inputElement: montoInput,
      //   mask: montoMask
      // });

    })(window.vanillaTextMask, window.textMaskAddons);
  </script>
@endpush
