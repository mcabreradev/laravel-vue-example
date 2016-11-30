@extends('layouts.app')

@section('content-header')
  Tipos <small>Configuraci&oacute;n</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::tipos') }}">Tipos</a></li>
@endsection


@section('content')

<div id="turnos-tables-container" class="row">
  <div class="col-xs-12">

    @include('flash::message')

    <smart-table
      :model='{singular: "Tipo", plural: "Tipos"}'
      :show-tfoot="false"
      :url="'solicitudes/tipos'"
      :fields="[
        {name: 'nombre', title: 'Nombre', type: 'text', required: true},
        {name: 'descripcion', title:'Descripción', type: 'textarea'},
        {name: 'color', title: 'Color', type: 'color'}
        ]"
    ></smart-table>

  </div>
</div>

@endsection
