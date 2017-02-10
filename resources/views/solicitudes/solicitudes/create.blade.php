@extends('layouts.app')

@section('content-header')
  Reclamos <small>Reclamos</small>
@endsection

@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::solicitudes') }}">Reclamos</a></li>
@endsection

@section('content')
  <form role="form" method="POST" action="{{ route('solicitudes::solicitudes.store') }}">
    {!! csrf_field() !!}
    @include('flash::message')

    @include('solicitudes.solicitudes.fields-datos-generales')

    <panal-box-slot title="Ubicación">
      <div slot="body">
        @include('solicitudes.solicitudes.fields-ubicacion')
      </div>
    </panal-box-slot>

    <panal-box-slot title="Reclamante">
      <div slot="body">
        @include('solicitudes.solicitudes.fields-solicitante')
      </div>
      <panal-indicator></panal-indicator>
    </panal-box-slot>

    <panal-box-slot title="Datos adicionales">
      <div slot="body">
        @include('solicitudes.solicitudes.fields-datos-adicionales')
      </div>
      <panal-indicator></panal-indicator>

      <div slot="footer">
        @include('common.form-buttons', ['route' => 'solicitudes::solicitudes'])
      </div>
    </panal-box-slot>
  </form>
@endsection

