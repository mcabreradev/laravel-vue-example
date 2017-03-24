@extends('layouts.base')

@section('body-attributes')
class="hold-transition login-page"
@endsection

@section('body-content')

<div class="login-box">

  <div class="login-box-body">

    @include('auth.encabezado')

    @include('flash::message')

    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form role="form" method="POST" action="{{ url('/login') }}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
        <input name="email" value="{{ old('email') }}" type="email" class="form-control" placeholder="E-mail" required>
        <span class="fa fa-envelope form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
        <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
        <span class="fa fa-lock form-control-feedback"></span>
      </div>

      <div class="row">

        <div class="col-xs-12">
          <a href="{{ route('auth::password.reset.form') }}">No recuerdo mi contraseña</a>
        </div>

        <div class="col-xs-12">
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="remember" checked> Recordarme
              </label>
            </div>
          </div>

          <div class="form-group">
            <a class="btn btn-success" href="{{ route('auth::register.form') }}">Registrarse</a>

            <button type="submit" class="btn btn-primary pull-right">
              <i class="fa fa-btn fa-sign-in"></i> Ingresar
            </button>
          </div>
        </div>
      </div>
    </form>
  </div> <!-- /.login-box-body -->
</div> <!-- /.login-box -->

@endsection
