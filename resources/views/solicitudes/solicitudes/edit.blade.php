@extends('layouts.app')

@section('content-header')
  Solicitantes <small>Configuraci&oacute;n</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::solicitantes') }}">Solicitantes</a></li>
@endsection

@section('content')
  <form role="form" method="POST" action="{{ route('solicitudes::solicitantes.update', $solicitud->id) }}">

    {{ method_field('PUT') }}

    @include('flash::message')

    <panal-box-slot title="Datos Generales">
      <div slot="body">
        @include('solicitudes.solicitudes.fields-datos-generales')
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

