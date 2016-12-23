@extends('layouts.app')

@section('content-header')
  Estados <small>Configuraci&oacute;n</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::estados') }}">Estados</a></li>
@endsection


@section('content')

  <panal-box
    :model='{singular: "estado", plural: "estados"}'
    :url="{simple: 'solicitudes.estados', doble:'solicitudes::estados'}"
    :type="'create'"
    :fields="[
      {name: 'nombre', title: 'Nombre', type: 'text', required: true},
      {name: 'descripcion', title:'Descripción', type: 'textarea'},
      {name: 'color', title: 'Color', type: 'color'}
      ]">
  </panal-box>

@endsection
