@extends('layouts.app')

@section('content-header')
  Usuarios <small>creando</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('admin::users.list') }}">Users</a></li>
@endsection


@section('content')
<div class="row">
  <div class="col-xs-12">

    <form role="form" method="POST" action="{{ route('admin::users.store') }}">
      {!! csrf_field() !!}

      @include('flash::message')

      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Nuevo usuario</h3>
        </div>

        <div class="box-body">
          @include('admin.users.fields')
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
