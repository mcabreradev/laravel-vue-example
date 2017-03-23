@extends('layouts.app')

@section('content-header')
  Mis Boletas <small>Oficina Virtual</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::solicitudes') }}">Oficina Virtual</a></li>
@endsection


@section('content')

<div id="turnos-tables-container" class="row">
  <div class="col-xs-12">

    @include('flash::message')

    <dposs-descargar-boleta :conexiones="{{ $conexiones }}"/>

  </div>
</div>

@endsection
