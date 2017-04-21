@extends('layouts.base')

@section('body-attributes')
class="hold-transition register-page"
@endsection

@section('body-content')

<div class="container">
  @include('auth.encabezado')

  <div class="row">
    <div class="col-xs-12">

      <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
        {!! csrf_field() !!}

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label class="col-md-4 control-label">E-mail</label>

          <div class="col-md-6">
            <input type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required>

            @if ($errors->has('email'))
            <span class="help-block">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <label class="col-md-4 control-label">Contraseña</label>

          <div class="col-md-6">
            <input type="password" class="form-control" name="password" required>

            @if ($errors->has('password'))
            <span class="help-block">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
          <label class="col-md-4 control-label">Repetir contraseña</label>
          <div class="col-md-6">
            <input type="password" class="form-control" name="password_confirmation" required>

            @if ($errors->has('password_confirmation'))
            <span class="help-block">
              <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
            @endif
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-10">
            <button type="submit" class="btn btn-primary pull-right">
              <i class="fa fa-btn fa-refresh"></i> Restablecer contraseña
            </button>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>


@endsection
