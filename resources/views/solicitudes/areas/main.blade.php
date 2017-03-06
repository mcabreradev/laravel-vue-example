@extends('layouts.app')

@section('content-header')
  Áreas <small>Configuración</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::solicitudes') }}">Reclamos</a></li>
<li><a href="{{ route('solicitudes::areas.list') }}">Áreas</a></li>
@endsection


@section('content')

<div id="turnos-tables-container" class="row">
  <div class="col-xs-12">

    @include('flash::message')

    <panal-table
      :model='{singular: "área", plural: "áreas"}'
      :url="{
        index: 'solicitudes::areas',
        store: 'solicitudes::areas.store',
        update: 'solicitudes::areas.update',
        destroy: 'solicitudes::areas.destroy'
      }"
      :has-modal="true"
      :fields="[
        {name: 'nombre', title: 'Nombre', type: 'text', required: true},
        {name: 'descripcion', title:'Descripción', type: 'textarea'},
        ]"
    ></panal-table>

  </div>
</div>

@endsection
