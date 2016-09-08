@extends('layouts.app')

@section('content-header')
Turnos asignados
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('turnos::index') }}">Turnos asignados</a></li>
@endsection


@section('content')

<div class="row">
  <div class="col-xs-12">

    <div class="box">
      <div class="box-header with-border">
        <h1>Turnos</h1>
        @include('flash::message')
      </div>

      <div class="box-body">

        @if($turnosVigentes->isEmpty())
          <div class="well text-center">No hay turnos asignados hoy ni en los próximos días</div>
        @else
          @include('turnos.index-table', ['turnos' => $turnosVigentes ])
        @endif

        @if($turnosVencidos->isEmpty())
          <div class="well text-center">No hay turnos que hayan vencido</div>
        @else
          @include('turnos.index-table', ['turnos' => $turnosVencidos ])
        @endif

      </div>

      <div class="box-footer">

      </div>
    </div> <!-- .box -->

  </div>
</div>

@endsection
