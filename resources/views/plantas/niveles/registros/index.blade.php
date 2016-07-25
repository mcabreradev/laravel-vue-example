@extends('layouts.app')

@section('content-header')
Nivel de agua en plantas
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('plantas.niveles.registros.index') }}"> Registros de nivel de agua</a></li>
@endsection


@section('content')

<div class="row">
  <div class="col-xs-12">

    <div class="box">
      <div class="box-header with-border">
        <h1>Registros de nivel de agua en plantas</h1>
        @include('flash::message')
      </div>

      <div class="box-body">

        <div class="row">
          <div class="col-xs-12">
            <button class="btn btn-primary pull-right" type="button" onclick="$('#crear-registro-modal').modal('show');">
              <span class="fa fa-plus"></span> Nuevo registro
            </button>
          </div>
        </div>

        @if($registros->isEmpty())
          <div class="well text-center">No hay registros históricos de niveles de agua en plantas</div>
        @else
          @include('plantas.niveles.registros.index-table')
        @endif
      </div>

      <div class="box-footer">

      </div>
    </div> <!-- .box -->

  </div>
</div>

@include('plantas.niveles.registros.create')

@endsection
