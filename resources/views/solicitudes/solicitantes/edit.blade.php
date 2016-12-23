@extends('layouts.app')

@section('content-header')
  Solicitantes <small>Configuraci&oacute;n</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::solicitantes') }}">Solicitantes</a></li>
@endsection


@section('content')
  <form role="form" method="POST" action="{{ route('solicitudes::solicitantes.update', $data->id) }}">
    {{ method_field('PUT') }}

    @include('flash::message')

    <panal-box-slot title="Persona de Contacto">

      <div slot="body">
        @include('solicitudes.solicitantes.fields')
      </div>

      <div slot="footer">
        @include('common.form-buttons', ['route' => 'solicitudes::solicitantes'])
      </div>

    </panal-box-slot>

  </form>
@endsection

