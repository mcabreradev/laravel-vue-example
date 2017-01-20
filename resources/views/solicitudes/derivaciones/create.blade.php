@extends('layouts.app')

@section('content-header')
  Derivaciones <small>Configuración</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::derivaciones') }}">Derivaciones</a></li>
@endsection

@section('content')
  <form role="form" method="POST" action="{{ route('solicitudes::derivaciones.store') }}">

    @include('flash::message')

    <panal-box-slot title="Datos Generales">
      <div slot="body">
        @include('solicitudes.derivaciones.fields')
      </div>
      <div slot="footer">
        @include('common.form-buttons', ['route' => 'solicitudes::derivaciones'])
      </div>
      <panal-indicator></panal-indicator>
    </panal-box-slot>

  </form>
@endsection

