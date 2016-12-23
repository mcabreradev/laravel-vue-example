@extends('layouts.app')

@section('content-header')
  Origenes <small>Configuraci&oacute;n</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::origenes') }}">Origenes</a></li>
@endsection


@section('content')

  <panal-box
    :model='{singular: "origen", plural: "origenes"}'
    :url="{simple: 'solicitudes.origenes', doble:'solicitudes::origenes'}"
    :type="'create'"
    :fields="[
      {name: 'nombre', title: 'Nombre', type: 'text', required: true},
      {name: 'descripcion', title:'Descripción', type: 'textarea'},
      {name: 'color', title: 'Color', type: 'color'}
      ]">
  </panal-box>

@endsection
