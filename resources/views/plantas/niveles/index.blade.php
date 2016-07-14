@extends('layouts.app')

@section('content-header')
Nivel de agua en plantas
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('plantas.niveles.index') }}"> Plantas</a></li>
@endsection


@section('content')

<div class="row">
  <div class="col-xs-12">

    <div class="box">
      <div class="box-header with-border">
        <h1>Lista de niveles</h1>
        @include('flash::message')
      </div>

      <div class="box-body">

        <div class="row">
          <div class="col-xs-12">
            <a class="btn btn-primary pull-right" href="#">
              <span class="fa fa-plus"></span> Nuevo nivel
            </a>
          </div>
        </div>

        @if($niveles->isEmpty())
          <div class="well text-center">No hay niveles definidos</div>
        @else
          @include('plantas.niveles.index-table')
        @endif
      </div>

      <div class="box-footer">

      </div>
    </div> <!-- .box -->

  </div>
</div>

@endsection
