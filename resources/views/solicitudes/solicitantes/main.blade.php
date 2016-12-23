@extends('layouts.app')

@section('content-header')
  Solicitantes <small>Configuraci&oacute;n</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::solicitantes') }}">Solicitantes</a></li>
@endsection


@section('content')

<div id="turnopanal-tables-container" class="row">
  <div class="col-xs-12">

    @include('flash::message')

    <panal-table
      :model='{singular: "solicitante", plural: "solicitantes"}'
      :url="{simple: 'solicitudes.solicitantes', doble:'solicitudes::solicitantes'}"
      :has-modal="false"
      :fields="[
        {name: 'apellido', title: 'Apellido', type: 'text', required: false},
        {name: 'nombre', title: 'Nombre', type: 'text', required: false},
        {name: 'documento', title: 'Documento', type: 'text', required: false},
        {name: 'telefono', title: 'Telefono', type: 'text', required: false},
        {name: 'celular', title: 'Celular', type: 'text', required: false},
        {name: 'email', title: 'Email', type: 'text', required: false},
        ]"
    ></panal-table>

  </div>
</div>

@endsection
