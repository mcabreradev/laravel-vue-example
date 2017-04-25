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
        <h3 class="box-title">Mostrando turnos para <strong>{{$actividadSeleccionada->nombre}}</strong></h3>
      </div>
      <div class="box-body">
        <form method="GET" class="form-inline">
          <div class="form-group">
            <label for="actividad_id">Mostrar turnos para: </label>
            <select class="form-control" name="actividad_id" id="actividad_id">
              @foreach($actividades as $actividad)
                <option value="{{$actividad->id}}" @if($actividad->id === $actividadSeleccionada->id) selected @endif >{{$actividad->nombre}}</option>
              @endforeach
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Seleccionar</button>
        </form>
      </div>
    </div>

    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Turnos Asignados</h3>
      </div>

      <div class="box-body">
        <turnos-table url-contenidos="{{ route('turnos::asignados-por-actividad', $actividadSeleccionada->id) }}"
          url-delete="{{route('turnos::destroy', '')}}"
          url-validar="{{route('turnos::validar-atencion', '')}}"></turnos-table>
      </div>
    </div> <!-- .box -->

    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Turnos vencidos</h3>
      </div>

      <div class="box-body">
        <turnos-table url-contenidos="{{ route('turnos::vencidos-por-actividad', $actividadSeleccionada->id) }}"
          url-delete="{{route('turnos::destroy', '')}}"
          url-validar="{{route('turnos::validar-atencion', '')}}"></turnos-table>
      </div>
    </div> <!-- .box -->

  </div>
</div>

@endsection
