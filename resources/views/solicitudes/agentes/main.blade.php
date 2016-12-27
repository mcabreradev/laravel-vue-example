@extends('layouts.app')

@section('content-header')
  Agentes <small>Derivaciones</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::agentes') }}">Agentes</a></li>
@endsection


@section('content')

<div id="turnos-tables-container" class="row">
  <div class="col-xs-12">

    @include('flash::message')

    <panal-table
      :model='{singular: "agente", plural: "agentes"}'
      :url="{simple: 'solicitudes.agentes', doble:'solicitudes::agente'}"
      :has-modal="true"
      :fields="[
        {name: 'apellido', title: 'Apellido', type: 'text', required: true},
        {name: 'nombre', title: 'Nombre', type: 'text', required: true},
        {name: 'legajo', title: 'Legajo', type: 'text', required: false},
        {name: 'telefono', title: 'Teléfono', type: 'text', required: false},
        {name: 'email', title: 'Email', type: 'text', required: false},
        ]"
    ></panal-table>

  </div>
</div>

@endsection
