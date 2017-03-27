@extends('layouts.app')

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

  @if(!$estadoServicio->vigente_has_alertas || !$estadoServicio->futuro_has_alertas)

    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box bg-red">
        <span class="info-box-icon"><i class="fa fa-wrench"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Agua potable</span>
          <span class="info-box-number">
            <a href="//dposs.gob.ar/#!/pagina/estado-de-la-red" class="a-white">
              Algunos barrios afectados
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
          <span class="info-box-text">Agua potable</span>
          <span class="info-box-number">No tenemos problemas reportados</span>
        </div> <!-- /.info-box-content -->
      </div> <!-- /.info-box -->
    </div> <!-- /.col -->

  @endif

  @if($estadoCuenta->impagasCant < 0)
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box bg-red">
        <span class="info-box-icon"><i class="fa fa-warning"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Pagos pendientes</span>
          <span class="info-box-number"><a href="#" class="a-white">Tenés {{ $estadoCuenta->impagasCant }} facturas pendientes de pago</a></span>
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
</div>

<div class="row">

</div>

<h2 class="page-header">Estado de cuenta</h2>
<div class="row">

  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa fa-usd"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Facturas adeudadas</span>

        @if($estadoCuenta->impagasCant < 0)
          <span class="info-box-number">$3.560</span>
          <a href="#" class="small-box-footer">Más información</a>
        @else
          <span class="info-box-number">No tenés facturas adeudadas</span>
        @endif
      </div> <!-- /.info-box-content -->
    </div> <!-- /.info-box -->
  </div> <!-- /.col -->

  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa fa-bar-chart"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Resumen histórico</span>
        <span class="info-box-number">{{ $estadoCuenta->historicoCant }} facturas</span>
        <a href="{{ route('oficina-virtual::boletas-de-pago') }}" class="small-box-footer">Descargar en PDF</a>
      </div><!-- /.info-box-content -->
    </div><!-- /.info-box -->
  </div> <!-- /.col -->

  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Boletas de pago</span>

        @if($estadoCuenta->impagasCant < 0)
          <span class="info-box-number">{{$estadoCuenta->impagasCant}} disponibles</span>
          <a href="#" class="small-box-footer">Descargar y pagar</a>
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
        <span class="info-box-number">Te avisaremos cuando esté listo</span>
        <a href="{{ route('oficina-virtual::solicitar-libre-deuda') }}" class="">Solicitar online</a>
      </div> <!-- /.info-box-content -->
    </div> <!-- /.info-box -->
  </div> <!-- /.col -->

  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Tu datos</span>
        <span class="info-box-number">Para estar mejor conectados</span>
        <a href="{{ route('users.profile') }}" class="">Actualizar tu información</a>
      </div> <!-- /.info-box-content -->
    </div> <!-- /.info-box -->
  </div>
</div>

@endsection
