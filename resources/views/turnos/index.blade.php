@extends('layouts.app')

@section('content-header')
Turnos asignados
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('turnos::index') }}">Turnos asignados</a></li>
@endsection


@section('content')

<div id="turnos-tables-container" class="row">
  <div class="col-xs-12">

    @include('flash::message')

    <div class="box">
      <div class="box-header with-border">
        <h1>Turnos Asignados</h1>
      </div>

      <div class="box-body">
        <turnos-table url-contenidos="{{ route('turnos::asignados-por-actividad', 1) }}"
          url-delete="{{route('turnos::destroy', '')}}"
          url-validar="{{route('turnos::validar-atencion', '')}}"></turnos-table>
      </div>
    </div> <!-- .box -->

    <div class="box">
      <div class="box-header with-border">
        <h1>Turnos vencidos</h1>
      </div>

      <div class="box-body">
        <turnos-table url-contenidos="{{ route('turnos::vencidos-por-actividad', 1) }}"
          url-delete="{{route('turnos::destroy', '')}}"
          url-validar="{{route('turnos::validar-atencion', '')}}"></turnos-table>
      </div>
    </div> <!-- .box -->

  </div>
</div>

@endsection
