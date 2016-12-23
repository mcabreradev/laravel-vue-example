@extends('layouts.app')

@section('content-header')
  Solicitudes <small>Configuraci&oacute;n</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::solicitudes') }}">Solicitudes</a></li>
@endsection


@section('content')

<div id="turnopanal-tables-container" class="row">
  <div class="col-xs-12">

    @include('flash::message')

    <panal-table-solicitudes
      :model='{singular: "solicitud", plural: "solicitudes"}'
      :url="{simple: 'solicitudes.solicitudes', doble:'solicitudes::solicitudes'}"
      :has-modal="true"
      :fields="[
        {name: 'id', title: 'Solicitud #', type: 'text', required: false},
        {name: 'creado_el', title: 'Fecha', type: 'text', required: false},
        {name: 'descripcion', title: 'Descripcion', type: 'text', required: false},
        ]"
    ></panal-table-solicitudes>

  </div>
</div>

@endsection
