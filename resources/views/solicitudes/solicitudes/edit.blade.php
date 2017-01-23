@extends('layouts.app')

@section('content-header')
  Reclamos <small>Reclamos</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::solicitudes') }}">Reclamos</a></li>
@endsection

@section('content')
  <form role="form" method="POST" action="{{ route('solicitudes::solicitudes.update', $solicitud->id) }}">

    {{ method_field('PUT') }}

    @include('flash::message')

    <panal-box-slot title="Datos Generales">
      <div slot="body">
        @include('solicitudes.solicitudes.fields-datos-generales')
      </div>
      <panal-indicator></panal-indicator>
    </panal-box-slot>

    <panal-box-slot title="Solicitante">
      <div slot="body">
        @include('solicitudes.solicitudes.fields-solicitante')
      </div>
      <panal-indicator></panal-indicator>
    </panal-box-slot>

     <panal-box-slot title="Ubicación">
        <div slot="body">
          @include('solicitudes.solicitudes.fields-ubicacion')
        </div>
        <panal-indicator></panal-indicator>
        <div slot="footer">
          @include('common.form-buttons', ['route' => 'solicitudes::solicitudes'])
        </div>
    </panal-box-slot>

    <dposs-derivaciones-tabla
      title="Derivaciones"
      :model='{singular: "derivación", plural: "derivaciones"}'
      :url="{simple: 'solicitudes.derivaciones', doble:'solicitudes::derivaciones'}"
      :where="{id: {{ $solicitud->id }} }"
      :fields="[
        {name: 'derivado_el', title: 'Fecha', type: 'datetime', required: true},
        {name: 'observaciones', title:'Observación', type: 'textarea'},
        {name: 'solicitud_id', type: 'hidden', value: {{$solicitud->id}} }
        ]"
    ></dposs-derivaciones-tabla>

    <panal-table title="Seguimientos"
      :model='{singular: "seguimiento", plural: "seguimientos"}'
      :url="{simple: 'solicitudes.seguimientos', doble:'solicitudes::seguimientos'}"
      :has-modal="true"
      :where="{id: {{ $solicitud->id }} }"
      :fields="[
        {name: 'generado_el', title: 'Fecha', type: 'datetime', required: true},
        {name: 'descripcion', title:'Descripción', type: 'textarea'},
        {name: 'solicitud_id', type: 'hidden', value: {{$solicitud->id}} }
        ]"
    ></panal-table>

  </form>
@endsection

