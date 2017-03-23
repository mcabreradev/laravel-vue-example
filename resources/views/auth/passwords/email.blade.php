@extends('layouts.base')

@section('body-attributes')
class="hold-transition register-page"
@endsection

@section('body-content')
<div class="container">
  @include('auth.encabezado')

  <div class="row">
    <div class="col-xs-12">
      @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
      @endif

      <form class="form-horizontal" role="form" method="POST" action="{{ route('auth::password.email') }}">
        {!! csrf_field() !!}

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label class="col-md-4 control-label">E-mail</label>

          <div class="col-md-6">
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
            <span class="help-block">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12 col-sm-8 col-sm-offset-4 col-md-6 col-md-offset-4 col-lg-4 col-lg-offset-6">
            <button type="submit" class="btn btn-primary btn-block">
              <i class="fa fa-btn fa-envelope"></i> Enviar correo para recuperar mi contraseña
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>


@endsection
