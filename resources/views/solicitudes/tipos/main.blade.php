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

    <panal-table
      :model='{singular: "tipo", plural: "tipos"}'
      :url="{simple: 'solicitudes.tipos', doble:'solicitudes::tipos'}"
      :fields="[
        {name: 'nombre', title: 'Nombre', type: 'text', required: true},
        {name: 'descripcion', title:'Descripción', type: 'textarea'},
        {name: 'color', title: 'Color', type: 'color'}
        ]"
    ></panal-table>

  </div>
</div>

@endsection
