@extends('layouts.app')

@section('content-header')
  Boletas de pago <small>Oficina Virtual</small>
@endsection

@section('content-breadcrumb')
<li><a href="{{ route('home') }}">Inicio</a></li>
<li><a href="{{ route('oficina-virtual::boletas-de-pago') }}">Boletas de pago</a></li>
@endsection


@section('content')

<div class="row">
  <div class="col-xs-12">

    @include('flash::message')

    <dposs-descargar-boleta :conexiones="{{ $conexiones }}"/>

  </div>
</div>

@endsection
