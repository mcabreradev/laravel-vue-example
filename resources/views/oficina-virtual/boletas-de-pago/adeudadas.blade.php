@extends('layouts.app')

@section('content-header')
  Facturas adeudadas <small>Oficina Virtual</small>
@endsection

@section('content-breadcrumb')
<li><a href="{{ route('home') }}">Inicio</a></li>
<li><a href="{{ route('oficina-virtual::facturas-adeudadas') }}">Facturas adeudadas</a></li>
@endsection


@section('content')

<div class="row">
  <div class="col-xs-12">

    @include('flash::message')

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Facturas adeudadas</h3>
      </div>
      <div class="box-body">
        <p>Aquí podrás descargar las boletas de pago para las facturas impagas sin vencer y solicitar las facturas vencidas.</p>
        <dposs-facturas-adedudadas :boletas="{{ $boletas }}"/>
      </div>
    </div>

  </div>
</div>

@endsection
