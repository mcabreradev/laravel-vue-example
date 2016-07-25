@extends('layouts.app')

@section('content-header')
Estados del servicio
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('cortes.estados.index') }}">Estados del servicio</a></li>
@endsection


@section('content')

<div class="row">
  <div class="col-xs-12">

    <div class="box">
      <div class="box-header with-border">
        <h1>Lista de estados del servicio</h1>
        @include('flash::message')
      </div>

      <div class="box-body">

        <div class="row">
          <div class="col-xs-12">
            <button class="btn btn-primary pull-right" type="button" onclick="$('#crear-estado-modal').modal('show');">
              <span class="fa fa-plus"></span> Nuevo estado
            </button>
          </div>
        </div>

        @if($estados->isEmpty())
          <div class="well text-center">No hay estados definidos</div>
        @else
          @include('cortes.estados.index-table')
        @endif
      </div>

      <div class="box-footer">

      </div>
    </div> <!-- .box -->

  </div>
</div>

@include('cortes.estados.create')

@endsection
