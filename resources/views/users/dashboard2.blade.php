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

  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="fa fa-tint"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Agua potable</span>
        <span class="info-box-number">No tenemos problemas reportados</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div><!-- /.col -->

  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="fa fa-thumbs-o-up"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Pagos pendientes</span>
        <span class="info-box-number">No tenés facturas pendientes de pago</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div><!-- /.col -->
  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="fa fa-comments-o"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Tus trámites</span>
        <span class="info-box-number">No hay ningún mensaje nuevo</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div><!-- /.col -->
</div>

<div class="row">
  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box bg-red">
      <span class="info-box-icon"><i class="fa fa-wrench"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Agua potable</span>
        <span class="info-box-number"><a href="#&#10;  " class="a-white">Tu zona está afectada a un reporte</a></span>
      </div> <!-- /.info-box-content -->
    </div> <!-- /.info-box -->
  </div> <!-- /.col -->

  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box bg-red">
      <span class="info-box-icon"><i class="fa fa-warning"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Pagos pendientes</span>
        <span class="info-box-number"><a href="#" class="a-white">Tenés 3 facturas pendientes de pago</a></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box bg-yellow">
      <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Tus trámites</span>
        <span class="info-box-number"><a href="#" class="a-white">Tenés mensajes nuevos</a></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
</div>

<h2 class="page-header">Estado de cuenta</h2>
<div class="row">

  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa fa-usd"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Facturas adeudadas</span>
        <span class="info-box-number">$3.560</span>
        <a href="#" class="small-box-footer">Más información
          No tenés facturas adeudadas
        </a>
      </div> <!-- /.info-box-content -->
    </div> <!-- /.info-box -->
  </div> <!-- /.col -->

  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa fa-bar-chart"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Resumen histórico</span>
        <span class="info-box-number">37 facturas</span>
        <a href="#" class="small-box-footer">Descargar en PDF
        </a>
      </div><!-- /.info-box-content -->
    </div><!-- /.info-box -->
  </div> <!-- /.col -->

  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Boletas de pago</span>
        <span class="info-box-number">3 disponibles</span>
        <a href="#" class="small-box-footer">Descargar y pagar</a>
      </div> <!-- /.info-box-content -->
    </div> <!-- /.info-box -->
  </div> <!-- /.col -->
</div> <!-- /.row -->

<h2 class="page-header">Acciones</h2>
<div class="row">
  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-credit-card"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Pago en linea</span>
        <span class="info-box-number">$3.560</span>
        <a href="#" class="small-box-footer">Pagar ahora, en internet</a>
      </div> <!-- /.info-box-content -->
    </div> <!-- /.info-box -->
  </div> <!-- /.col -->

  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-mobile"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Alertas por SMS</span>
        <span class="info-box-number">Enterate al instante</span>
        <a href="#" class="small-box-footer">Registrar celular</a>
      </div> <!-- /.info-box-content -->
    </div> <!-- /.info-box -->
  </div> <!-- /.col -->

  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-comments-o"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Oficina de atención</span>
        <span class="info-box-number">Sugerencias y reclamos</span>
        <a href="#" class="small-box-footer">Seguimiento de mensajes</a>
      </div> <!-- /.info-box-content -->
    </div> <!-- /.info-box -->
  </div> <!-- /.col -->

  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Libre deuda</span>
        <span class="info-box-number">Te avisaremos cuando esté listo</span>
        <a href="#" class="">Solicitar online</a>
      </div> <!-- /.info-box-content -->
    </div> <!-- /.info-box -->
  </div> <!-- /.col -->

  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Tu datos</span>
        <span class="info-box-number">Para estar mejor conectados</span>
        <a href="#" class="">Actualizar tu información</a>
      </div> <!-- /.info-box-content -->
    </div> <!-- /.info-box -->
  </div>
</div>

@endsection
