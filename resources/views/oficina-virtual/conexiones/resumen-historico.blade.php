@extends('layouts.app')

@section('content-header')
  Resumen histórico <small>Oficina Virtual</small>
@endsection

@section('content-breadcrumb')
<li><a href="{{ route('home') }}">Inicio</a></li>
<li><a href="{{ route('oficina-virtual::resumen-historico-facturas') }}">Resumen histórico</a></li>
@endsection


@section('content')

<div class="row">
  <div class="col-xs-12">

    @include('flash::message')

    <dposs-resumen-historico :conexiones="{{ $conexiones }}"/>

  </div>
</div>

@endsection
