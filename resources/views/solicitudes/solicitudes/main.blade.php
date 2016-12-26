@extends('layouts.app')

@section('content-header')
  Reclamos <small>Solicitudes</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::solicitudes') }}">Reclamos</a></li>
@endsection


@section('content')

<div id="turnopanal-tables-container" class="row">
  <div class="col-xs-12">

    @include('flash::message')

    <panal-table-solicitudes
      :model='{singular: "reclamo", plural: "reclamos"}'
      :url="{simple: 'solicitudes.solicitudes', doble:'solicitudes::solicitudes'}"
      :has-modal="false"
      :fields="[
        {name: 'id', title: 'Solicitud #'},
        {name: 'creado_el', title: 'Fecha'},
        {name: 'descripcion', title: 'Descripcion'},
        ]"
    ></panal-table-solicitudes>

  </div>
</div>

@endsection
