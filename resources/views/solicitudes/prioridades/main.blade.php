@extends('layouts.app')

@section('content-header')
  Prioridades <small>Configuraci&oacute;n</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::prioridades') }}">Prioridades</a></li>
@endsection


@section('content')

<div id="turnos-tables-container" class="row">
  <div class="col-xs-12">

    @include('flash::message')

    <smart-table
      :model='{singular: "Prioridad", plural: "Prioridades"}'
      :show-tfoot="false"
      :url="'solicitudes/prioridades'"
      :fields="['nombre', 'descripcion', 'color']"
    ></smart-table>

  </div>
</div>

@endsection
