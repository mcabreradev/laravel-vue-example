@extends('layouts.app')

@section('content-header')
  Origenes <small>Configuraci&oacute;n</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::origenes') }}">Origenes</a></li>
@endsection


@section('content')
<s-formbox
  :model='{singular: "origen", plural: "origenes"}'
  :url="{simple: 'solicitudes.origenes', doble:'solicitudes::origenes'}"
  :type="'edit'"
  :item="{{ $item }}"
  :fields="[
    {name: 'nombre', title: 'Nombre', type: 'text', required: true},
    {name: 'descripcion', title:'Descripción', type: 'textarea'},
    {name: 'color', title: 'Color', type: 'color'}
    ]">
</s-formbox>
@endsection
