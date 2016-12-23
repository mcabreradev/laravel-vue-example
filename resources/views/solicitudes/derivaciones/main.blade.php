@extends('layouts.app')

@section('content-header')
  Derivaciones <small>Configuraci&oacute;n</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::derivaciones') }}">Derivaciones</a></li>
@endsection


@section('content')

<div id="turnopanal-tables-container" class="row">
  <div class="col-xs-12">

    @include('flash::message')

    <panal-table
      :model='{singular: "derivacion", plural: "derivaciones"}'
      :url="{simple: 'solicitudes.derivaciones', doble:'solicitudes::derivaciones'}"
      :has-modal="false"
      :fields="[
        {name: 'id', title: 'Derivacion', type: 'text', required: false},
        {name: 'derivado_el', title: 'Fecha', type: 'text', required: false},
        {name: 'observaciones', title: 'Observaciones', type: 'text', required: false},
        {name: 'solicitud_id', title: 'Solicitud', type: 'text', required: false},
        {name: 'area_id', title: 'Area', type: 'text', required: false},
        ]"
    ></panal-table>

  </div>
</div>

@endsection
