@extends('layouts.app')

@section('content-header')
  Seguimientos <small>Solicitudes</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::solicitudes') }}">Reclamos</a></li>
@endsection


@section('content')

<div class="row">
  <div class="col-xs-12">
    <dposs-timeline solicitud="{{ $solicitud }}"></dposs-timeline>
  </div>
</div>

@endsection
