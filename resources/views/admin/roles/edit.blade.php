@extends('layouts.app')

@section('content-header')
  Rol <small>editando</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('admin::roles.list') }}"> Roles</a></li>
@endsection


@section('content')
<div class="row">
  <div class="col-xs-12">

    <form role="form" method="POST" action="{{ route('admin::roles.update', $role->id) }}">
      {!! csrf_field() !!}
      {{ method_field('PUT') }}

      @include('flash::message')

      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Editando rol</h3>
        </div>

        <div class="box-body">

          @include('admin.roles.fields')
        </div>

        <div class="box-footer">
          <div class="pull-right">
            <a href="{{ route('admin::roles.list') }}" class="btn btn-default">
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
