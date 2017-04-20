@extends('layouts.app', ['noBreadcrumb' => true])

@push('head-scripts')
<style>
  a.a-white {
    color: white;
  }

  a:hover.a-white {
    text-decoration: underline;
  }
</style>
@endpush

@section('content-header') @endsection

@section('content-breadcrumb') @endsection

@section('content')

@include('flash::message')

<h2 class="page-header">Resumen del servicio</h2>
<div class="row">

  @if($estadoServicio->vigente_has_alertas || $estadoServicio->futuro_has_alertas)

    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box bg-red">
        <span class="info-box-icon"><i class="fa fa-wrench"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Estado de la red</span>
          <span class="info-box-number">
            <a href="//dposs.gob.ar/#!/pagina/estado-de-la-red" class="a-white">
              @if($estadoServicio->vigente_has_alertas){{ $estadoServicio->vigente }}@else{{ $estadoServicio->futuro }}@endif (ver mapa)
            </a>
          </span>
        </div> <!-- /.info-box-content -->
      </div> <!-- /.info-box -->
    </div> <!-- /.col -->

  @else

    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-tint"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Estado de la red</span>
          <span class="info-box-number">No tenemos problemas reportados en Ushuaia</span>
        </div> <!-- /.info-box-content -->
      </div> <!-- /.info-box -->
    </div> <!-- /.col -->

  @endif

  @if($deudaTotal > 0)
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box bg-red">
        <span class="info-box-icon"><i class="fa fa-warning"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Estado de cuentas</span>
          <span class="info-box-number">
            <a href="{{ route('oficina-virtual::deudas-pendientes') }}" class="a-white">
              Registras deudas pendientes de pago
            </a>
          </span>
        </div> <!-- /.info-box-content -->
      </div> <!-- /.info-box -->
    </div> <!-- /.col -->
  @else
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-thumbs-o-up"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Estado de cuentas</span>
          <span class="info-box-number">No tenés deudas</span>
        </div> <!-- /.info-box-content -->
      </div> <!-- /.info-box -->
    </div> <!-- /.col -->
  @endif

</div>

<h2 class="page-header">Estado de cuenta</h2>

<div class="row">

  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa fa-usd"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Deudas pendientes</span>

        @if($deudaTotal > 0)
          <span class="info-box-number">$ {{ number_format($deudaTotal, 2, ',' , '.' ) }} + intereses</span>
        @else
          <span class="info-box-number">No tenés deuda</span>
        @endif
        <a href="{{ route('oficina-virtual::deudas-pendientes') }}" class="small-box-footer">Más información</a>
      </div> <!-- /.info-box-content -->
    </div> <!-- /.info-box -->
  </div> <!-- /.col -->

  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa fa-bar-chart"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Cuentas claras</span>
        <span class="info-box-number">
          {{$estadoFacturas->historico}} facturas en histórico
        </span>
        <a href="{{ route('oficina-virtual::resumen-historico-facturas') }}" class="small-box-footer">Ver y descargar</a>
      </div><!-- /.info-box-content -->
    </div><!-- /.info-box -->
  </div> <!-- /.col -->

  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Boletas de pago</span>

        @if($estadoFacturas->porPagar)
          <span class="info-box-number">{{$estadoFacturas->porPagar}} {{$estadoFacturas->porPagar > 1 ? 'disponibles' : 'disponible'}}</span>
          <a href="{{ route('oficina-virtual::boletas-de-pago') }}" class="small-box-footer">Descargar y pagar</a>
        @else
          <span class="info-box-number">No tenés boletas para descargar</span>
        @endif

      </div> <!-- /.info-box-content -->
    </div> <!-- /.info-box -->
  </div> <!-- /.col -->
</div> <!-- /.row -->

<h2 class="page-header">Acciones</h2>
<div class="row">

  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-plus"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Avanzadas</span>
        <span class="info-box-number">Vinculá más cuentas</span>
        <a href="{{ route('oficina-virtual::conexiones.vinculadas') }}">Centralizá toda tu info</a>
      </div> <!-- /.info-box-content -->
    </div> <!-- /.info-box -->
  </div>

  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-bell-o"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Registro histórico</span>
        <span class="info-box-number">Centro de notificaciones</span>
        <a href="#">Acceder </a>
      </div> <!-- /.info-box-content -->
    </div> <!-- /.info-box -->
  </div> <!-- /.col -->

  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-handshake-o"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Solicitar online</span>
        <span class="info-box-number">Libre deuda</span>
        <a href="{{ route('oficina-virtual::solicitar-libre-deuda') }}">Acceder al formulario</a>
      </div> <!-- /.info-box-content -->
    </div> <!-- /.info-box -->
  </div> <!-- /.col -->

  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Tus datos</span>
        <span class="info-box-number">Para comunicarnos mejor</span>
        <a href="{{ route('users.profile') }}">Actualizar tu información</a>
      </div> <!-- /.info-box-content -->
    </div> <!-- /.info-box -->
  </div>
</div>

@endsection
