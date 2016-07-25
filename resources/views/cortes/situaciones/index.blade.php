@extends('layouts.app')

@section('content-header')
Situaciones
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('cortes.situaciones.index') }}"> Situaciones</a></li>
@endsection


@section('content')

<div class="row">
  <div class="col-xs-12">

    <div class="box">
      <div class="box-header with-border">
        <h1>Situación actual de cortes</h1>
        @include('flash::message')
      </div>

      <div class="box-body">

        <div class="row">
          <div class="col-xs-12">
            <a class="btn btn-primary pull-right" href="{{ route('cortes.situaciones.create') }}">
              <span class="fa fa-plus"></span> Nueva situación
            </a>
          </div>
        </div>

        @if($situaciones->isEmpty())
          <div class="well text-center">No se cargaron situaciones de cortes</div>
        @else
          @include('cortes.situaciones.index-table')
        @endif
      </div>

      <div class="box-footer">

      </div>
    </div> <!-- .box -->

  </div>
</div>

@endsection
