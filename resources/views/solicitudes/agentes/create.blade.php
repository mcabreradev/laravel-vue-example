@extends('layouts.app')

@section('content-header')
  Tipos <small>Configuración</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::tipos') }}">Tipos</a></li>
@endsection


@section('content')

  <panal-box
    :model='{singular: "tipo", plural: "tipos"}'
    :url="{simple: 'solicitudes.tipos', doble:'solicitudes::tipos'}"
    :type="'create'"
    :fields="[
      {name: 'nombre', title: 'Nombre', type: 'text', required: true},
      {name: 'descripcion', title:'Descripción', type: 'textarea'},
      {name: 'color', title: 'Color', type: 'color'}
      ]">
  </panal-box>

@endsection
