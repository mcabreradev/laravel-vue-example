@extends('layouts.app')

@section('content-header')
Perfil de usuario <small>tu información</small>
@endsection

@section('content-breadcrumb')
<li><a href="{{ route('home') }}">Inicio</a></li>
<li><a href="{{ route('users.profile') }}">Tus datos</a></li>
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12">

    <form role="form" method="POST" action="{{ route('users.profile') }}">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Tus datos</h3>
        </div>

        <div class="box-body">
          @include('flash::message')


          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_method" value="PUT">

          @include('users.fields')

        </div>

        <div class="box-footer">
          <div class="form-group">
            <div class="pull-right">
              <button class="btn btn-success" type="submit">
                <span class="fa fa-check"></span> Guardar
              </button>
            </div>
          </div>
        </div>
      </div> <!-- .box -->
    </form>
  </div>
</div>
@endsection
