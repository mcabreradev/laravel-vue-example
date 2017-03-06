@extends('layouts.app')

@section('content-header')
  Estados <small>Configuración</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::solicitudes') }}">Reclamos</a></li>
<li><a href="{{ route('solicitudes::estados.list') }}">Estados</a></li>
@endsection


@section('content')

<div id="turnos-tables-container" class="row">
  <div class="col-xs-12">

    @include('flash::message')

    <panal-table
      :model='{singular: "estado", plural: "estados"}'
      :url="{
        index: 'solicitudes::estados',
        store: 'solicitudes::estados.store',
        update: 'solicitudes::estados.update',
        destroy: 'solicitudes::estados.destroy'
      }"
      :has-modal="true"
      :fields="[
        {name: 'nombre', title: 'Nombre', type: 'text', required: true},
        {name: 'descripcion', title:'Descripción', type: 'textarea'},
        {name: 'color', title: 'Color', type: 'color'}
        ]"
    ></panal-table>

  </div>
</div>

@endsection
