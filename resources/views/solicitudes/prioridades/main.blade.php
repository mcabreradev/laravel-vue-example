@extends('layouts.app')

@section('content-header')
  Prioridades <small>Configuración</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::prioridades') }}">Prioridades</a></li>
@endsection


@section('content')

<div id="turnos-tables-container" class="row">
  <div class="col-xs-12">

    @include('flash::message')

    <panal-table
      :model='{singular: "prioridad", plural: "prioridades"}'
      :url="{simple: 'solicitudes.prioridades', doble:'solicitudes::prioridades'}"
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
