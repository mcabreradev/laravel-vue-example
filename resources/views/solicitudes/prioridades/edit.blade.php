@extends('layouts.app')

@section('content-header')
  Prioridades <small>Configuración</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::prioridades') }}">Prioridades</a></li>
@endsection


@section('content')

  <panal-box
    :model='{singular: "prioridad", plural: "prioridades"}'
    :url="{simple: 'solicitudes.prioridades', doble:'solicitudes::prioridades'}"
    :type="'edit'"
    :item="{{ $item }}"
    :fields="[
      {name: 'nombre', title: 'Nombre', type: 'text', required: true},
      {name: 'descripcion', title:'Descripción', type: 'textarea'},
      {name: 'color', title: 'Color', type: 'color'}
      ]">
  </panal-box>

@endsection
