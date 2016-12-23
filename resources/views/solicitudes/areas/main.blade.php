@extends('layouts.app')

@section('content-header')
  Areas <small>Derivaciones</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::areas') }}">Areas</a></li>
@endsection


@section('content')

<div id="turnos-tables-container" class="row">
  <div class="col-xs-12">

    @include('flash::message')

    <panal-table
      :model='{singular: "area", plural: "areas"}'
      :url="{simple: 'solicitudes.areas', doble:'solicitudes::areas'}"
      :has-modal="true"
      :fields="[
        {name: 'nombre', title: 'Nombre', type: 'text', required: true},
        {name: 'descripcion', title:'Descripción', type: 'textarea'},
        ]"
    ></panal-table>

  </div>
</div>

@endsection
