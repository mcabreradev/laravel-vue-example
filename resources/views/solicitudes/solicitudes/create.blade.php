@extends('layouts.app')

@section('content-header')
  Reclamos <small>Solicitudes</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::solicitudes') }}">Reclamos</a></li>
@endsection

@section('content')
  <form role="form" method="POST" action="{{ route('solicitudes::solicitudes.store') }}">

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
      <div slot="footer">
        @include('common.form-buttons', ['route' => 'solicitudes::solicitudes'])
      </div>
    </panal-box-slot>

  </form>
@endsection

