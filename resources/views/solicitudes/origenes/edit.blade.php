@extends('layouts.app')

@section('content-header')
  Orígenes <small>Configuración</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::origenes') }}">Orígenes</a></li>
@endsection


@section('content')

  <panal-box
    :model='{singular: "origen", plural: "origenes"}'
    :url="{simple: 'solicitudes.origenes', doble:'solicitudes::origenes'}"
    :type="'edit'"
    :item="{{ $item }}"
    :fields="[
      {name: 'nombre', title: 'Nombre', type: 'text', required: true},
      {name: 'descripcion', title:'Descripción', type: 'textarea'},
      {name: 'color', title: 'Color', type: 'color'}
      ]">
  </panal-box>

@endsection
