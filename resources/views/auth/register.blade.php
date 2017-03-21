@extends('layouts.base')

@section('body-attributes')
class="hold-transition register-page"
@endsection

@section('body-content')

<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <div class="text-center">
        <img src="{{ asset('img/dposs-logo.png') }}"><br><br>
        <p class="register-box-msg">Oficina Virtual de la D.P.O.S.S</p>
      </div>
    </div>
  </div>

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
        <h4 class="well">Datos de alguna factura</h4>

        <div class="form-group">
          <label for="nro_factura">Número de factura <span class="text-danger">*</span></label>
          <div class="input-group">
            <input type="text" class="form-control" name="nro_factura" id="nro_factura" value="{{ old('nro_factura') }}" required>
            <span class="input-group-btn">
              <a href="http://dposs.gob.ar/wordpress/wp-content/uploads/2017/03/factura-ayuda-liquidacion-sp.jpg" class="btn btn-warning" target="_blank" rel="noopener noreferrer"><i class="fa fa-question-circle"></i> </a>
            </span>
          </div>
        </div>

        <div class="form-group">
          <label for="periodo_factura">Período de factura <span class="text-danger">*</span></label>
          <div class="input-group">
            <input type="text" class="form-control" name="periodo_factura" id="periodo_factura" value="{{ old('periodo_factura') }}" required>
            <span class="input-group-btn">
              <a href="http://dposs.gob.ar/wordpress/wp-content/uploads/2017/03/factura-ayuda-periodo.jpg" class="btn btn-warning" target="_blank" rel="noopener noreferrer"><i class="fa fa-question-circle"></i>  </a>
            </span>
          </div>
        </div>

        <div class="form-group">
          <label for="monto_factura">Monto de factura <span class="text-danger">*</span></label>
          <div class="input-group">
            <input type="text" class="form-control" name="monto_factura" id="monto_factura" value="{{ old('monto_factura') }}" required>
            <span class="input-group-btn">
              <a href="http://dposs.gob.ar/wordpress/wp-content/uploads/2017/03/factura-ayuda-monto.jpg" class="btn btn-warning" target="_blank" rel="noopener noreferrer"><i class="fa fa-question-circle"></i>  </a>
            </span>
          </div>
        </div>

        <div class="form-group">
          <label for="expediente">Expediente <span class="text-danger">*</span></label>
          <div class="input-group">
            <input type="text" class="form-control" name="expediente" id="expediente" value="{{ old('expediente') }}" required>
            <span class="input-group-btn">
              <a href="http://dposs.gob.ar/wordpress/wp-content/uploads/2017/03/factura-ayuda-expediente.jpg" class="btn btn-warning" target="_blank" rel="noopener noreferrer"><i class="fa fa-question-circle"></i> </a>
            </span>
          </div>
        </div>
      </div> <!-- /.col-xs-12 col-sm-6 -->

      <div class="col-xs-12 col-sm-6">
        <h4 class="well">Datos de tu cuenta</h4>

        <div class="form-group">
          <label for="name">Nombre <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
          <label for="email">Email <span class="text-danger">*</span></label>
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
          <label for="telefono">Teléfono o celular</label>
          <input type="number" class="form-control" name="telefono" id="telefono" value="{{ old('telefono') }}">
        </div>
      </div> <!-- /.col-xs-12 col-sm-6 -->
    </div> <!-- /.row -->

    <div class="row">
      <div class="col-xs-12 col-sm-6 col-sm-offset-6">
        <button type="submit" class="btn btn-success btn-lg btn-block">Registrarse</button>
      </div>
    </div>
  </form>
</div>

@endsection
