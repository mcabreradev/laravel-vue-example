@extends('layouts.app')

@section('content-header')
  Orígenes <small>Configuración</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::solicitudes') }}">Reclamos</a></li>
<li><a href="{{ route('solicitudes::origenes.list') }}">Orígenes</a></li>
@endsection


@section('content')

<div id="turnos-tables-container" class="row">
  <div class="col-xs-12">

    @include('flash::message')

    <panal-table
      :model='{singular: "origen", plural: "orígenes"}'
      :url="{
        index: 'solicitudes::origenes',
        store: 'solicitudes::origenes.store',
        update: 'solicitudes::origenes.update',
        destroy: 'solicitudes::origenes.destroy'
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
