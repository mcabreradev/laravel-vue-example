@extends('layouts.app')

@section('content-header')
  Users <small>editando</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('admin::users.list') }}">Usuarios</a></li>
@endsection


@section('content')
<div class="row">
  <div class="col-xs-12">

    <form role="form" method="POST" action="{{ route('admin::users.update', $user->id) }}">
      {!! csrf_field() !!}
      {{ method_field('PUT') }}

      @if (session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
      @endif
      @include('flash::message')

      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Editando usuario</h3>
        </div>

        <div class="box-body">

          @include('admin.users.fields')

          <div class="row">
            <div class="col-xs-12">
              <a href="{{ route('admin::users.send-reset-password') }}?email={{ $user->email }}" class="btn btn-primary" onclick="return confirm('¿Confirma?')">
                <i class="fa fa-lock"></i> Enviar correo para recuperar contraseña
              </a>
              <a href="{{ route('admin::users.send-verification-email', $user->id) }}" class="btn btn-primary" onclick="return confirm('¿Confirma?')">
                <i class="fa fa-envelope"></i> Enviar correo para verificar e-mail
              </a>
            </div>
          </div>
        </div>

        <div class="box-footer">
          <div class="pull-right">
            <a href="{{ route('admin::users.list') }}" class="btn btn-default">
              <span class="fa fa-undo"></span> Cancelar
            </a>
            <button class="btn btn-success" type="submit">
              <span class="fa fa-check"></span> Guardar
            </button>
          </div>
        </div>
      </div> <!-- .box -->
    </form>
  </div>
</div>
@endsection
