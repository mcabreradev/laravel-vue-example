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
              @if($estadoServicio->vigente_has_alertas)
                {{ $estadoServicio->vigente }}
              @else
                {{ $estadoServicio->futuro }}
              @endif
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
{{--
  @if($estadoCuenta->impagasCant)
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box bg-red">
        <span class="info-box-icon"><i class="fa fa-warning"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Pagos pendientes</span>
          <span class="info-box-number">
            <a href="{{ route('oficina-virtual::facturas-adeudadas') }}" class="a-white">
              Tenés {{ $estadoCuenta->impagasCant }} facturas pendientes de pago
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
          <span class="info-box-text">Pagos pendientes</span>
          <span class="info-box-number">No tenés facturas pendientes de pago</span>
        </div> <!-- /.info-box-content -->
      </div> <!-- /.info-box -->
    </div> <!-- /.col -->
  @endif
   --}}
</div>

<h2 class="page-header">Estado de cuenta</h2>

<div class="row">

  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa fa-usd"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Facturas adeudadas</span>

        {{-- @if($estadoCuenta->impagasCant)
          <span class="info-box-number">$ {{ number_format($estadoCuenta->impagasMonto, 2, ',' , '.' ) }}</span>
          <a href="{{ route('oficina-virtual::facturas-adeudadas') }}" class="small-box-footer">Más información</a>
        @else
          <span class="info-box-number">No tenés facturas adeudadas</span>
        @endif --}}
      </div> <!-- /.info-box-content -->
    </div> <!-- /.info-box -->
  </div> <!-- /.col -->

  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa fa-bar-chart"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Resumen histórico</span>
        <span class="info-box-number">
          {{((!$estadoFacturas->porPagar) && (!$estadoFacturas->vencidas)) ? 'Tus facturas estan al día' : '' }}{{$estadoFacturas->porPagar ? "{$estadoFacturas->porPagar} por pagar" : ''}}{{($estadoFacturas->porPagar && $estadoFacturas->vencidas) ? ', ' : ''}}{{$estadoFacturas->vencidas ? "{$estadoFacturas->vencidas} vencidas" : ''}}
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
      <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Libre deuda</span>
        <span class="info-box-number">Te diremos cuando esté listo</span>
        <a href="{{ route('oficina-virtual::solicitar-libre-deuda') }}" class="">Solicitar online</a>
      </div> <!-- /.info-box-content -->
    </div> <!-- /.info-box -->
  </div> <!-- /.col -->

  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Tu datos</span>
        <span class="info-box-number">Para comunicarnos mejor</span>
        <a href="{{ route('users.profile') }}" class="">Actualizar tu información</a>
      </div> <!-- /.info-box-content -->
    </div> <!-- /.info-box -->
  </div>
</div>

@endsection
