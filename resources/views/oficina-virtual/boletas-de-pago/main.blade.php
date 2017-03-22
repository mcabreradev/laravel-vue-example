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

    <panal-box-slot title="Descargar boleta de pago">
      <div slot="body">
        @include('oficina-virtual.boletas-de-pago.fields')
      </div>
    </panal-box-slot>

  </div>
</div>

@endsection
