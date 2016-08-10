@extends('layouts.app')

@section('content-header')
Mapa de alertas
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('alertas::index') }}">Mapa de alertas</a></li>
@endsection


@section('content')

<div class="row">
  <div class="col-xs-12">

    <div class="box">
      <div class="box-header with-border">
        <h1>Alertas</h1>
        @include('flash::message')
      </div>

      <div class="box-body">

        <div class="row">
          <div class="col-xs-12">
            <a class="btn btn-default" href="{{ route('alertas::estados.index') }}">
              <span class="fa fa-info-circle"></span> Ver estados definidos
            </a>
            <a class="btn btn-primary pull-right" href="{{ route('alertas::create') }}">
              <span class="fa fa-plus"></span> Nueva alerta
            </a>
          </div>
        </div>
        <br>

        @if($alertas->isEmpty())
          <div class="well text-center">No se cargaron alertas</div>
        @else
          @include('alertas.index-table')
        @endif
      </div>

      <div class="box-footer">

      </div>
    </div> <!-- .box -->

  </div>
</div>

@endsection
