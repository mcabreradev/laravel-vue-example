@extends('layouts.app')

@section('content-header')
  Reclamos <small>Reclamos</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::solicitudes') }}">Reclamos</a></li>
@endsection


@section('content')

<div id="turnopanal-tables-container" class="row">
  <div class="col-xs-12">

    @include('flash::message')

  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="{{ ($estado === '' ? 'active' : '') }}"><a href="{{ route('solicitudes::solicitudes', ['estado' => '']) }}">En proceso</a></li>
      <li class="{{ ($estado === 'cerrado' ? 'active' : '') }}"><a href="{{ route('solicitudes::solicitudes', ['estado' => 'cerrado']) }}">Cerrados</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane {{ ($estado === '' ? 'active' : '') }}" id="tab_1">
        @if($estado === '')
          <dposs-tabla-solicitudes
            :model='{singular: "reclamo", plural: "reclamos"}'
            :has-modal="false"
            :fields="[]"
          ></dposs-tabla-solicitudes>
        @endif
      </div>
      <!-- /.tab-pane -->
      <div class="tab-pane {{ ($estado === 'cerrado' ? 'active' : '') }}" id="tab_2">
        @if($estado === 'cerrado')
          <dposs-tabla-solicitudes
            :model='{singular: "reclamo", plural: "reclamos"}'
            :url="{simple: 'solicitudes.solicitudes', doble:'solicitudes::solicitudes'}"
            :has-modal="false"
            :estado-cerrado="true"
            :fields="[]"
          ></dposs-tabla-solicitudes>
        @endif
      </div>
    </div>
    <!-- /.tab-content -->
  </div>

  </div>
</div>

@endsection
