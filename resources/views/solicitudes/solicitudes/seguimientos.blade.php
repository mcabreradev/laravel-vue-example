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
    <h4>Reclamo: "{{ $solicitud->descripcion }}"</h4>
    <br>
    <ul class="timeline">
      @foreach($seguimientos as $seguimiento)
        <!-- timeline time label -->
        <li class="time-label">
            <span class="bg-gray-light">
                {{ $seguimiento->generado_el->format('d/m/Y') }}
            </span>
        </li>
        <!-- /.timeline-label -->

        <!-- timeline item -->
        <li>
            <!-- timeline icon -->
            <i class="fa fa-envelope bg-light-blue"></i>
            <div class="timeline-item">
                <h3 class="timeline-header no-border"><b>Seguimiento:</b> {{ $seguimiento->descripcion }}</h3>
            </div>
        </li>
        <!-- END timeline item -->
      @endforeach
      <li>
        <i class="fa fa-clock-o bg-light-blue"></i>
      </li>
    </ul>
  </div>
</div>

@endsection
