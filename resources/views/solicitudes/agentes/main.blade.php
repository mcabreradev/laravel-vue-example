@extends('layouts.app')

@section('content-header')
  Agentes <small>Configuración</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::solicitudes') }}">Reclamos</a></li>
<li><a href="{{ route('solicitudes::agentes.list') }}">Agentes</a></li>
@endsection


@section('content')

<div id="turnos-tables-container" class="row">
  <div class="col-xs-12">

    @include('flash::message')

    <panal-table
      :model='{singular: "agente", plural: "agentes"}'
      :url="{
        index: 'solicitudes::agentes',
        store: 'solicitudes::agentes.store',
        update: 'solicitudes::agentes.update',
        destroy: 'solicitudes::agentes.destroy'
      }"
      :has-modal="true"
      :fields="[
        {name: 'apellido', title: 'Apellido', type: 'text', required: true},
        {name: 'nombre', title: 'Nombre', type: 'text', required: false},
        {name: 'telefono', title: 'Teléfono', type: 'text', required: false},
        {name: 'email', title: 'Email', type: 'text', required: false},
        ]"
    ></panal-table>

  </div>
</div>

@endsection
