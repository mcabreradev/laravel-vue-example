@extends('layouts.app')

@section('content-header')
  Tipos <small>Configuración</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::tipos.list') }}">Tipos</a></li>
@endsection


@section('content')

<div id="turnos-tables-container" class="row">
  <div class="col-xs-12">

    @include('flash::message')

    <panal-table
      :model='{singular: "tipo", plural: "tipos"}'
      :url="{
        index: 'solicitudes::tipos',
        store: 'solicitudes::tipos.store',
        update: 'solicitudes::tipos.update',
        destroy: 'solicitudes::tipos.destroy'
      }"
      :fields="[
        {name: 'nombre', title: 'Nombre', type: 'text', required: true},
        {name: 'descripcion', title:'Descripción', type: 'textarea'},
        {name: 'color', title: 'Color', type: 'color'}
        ]"
    ></panal-table>

  </div>
</div>

@endsection
