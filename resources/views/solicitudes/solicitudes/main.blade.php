@extends('layouts.app')

@section('content-header')
  Reclamos <small>Reclamos</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::solicitudes') }}">Reclamos</a></li>
@endsection


@section('content')

<div class="row">
  <div class="col-xs-12">

    @include('flash::message')

  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      @foreach($estados as $estado)
        <li class="{{ ($estado->id == $estadoActivo ? 'active' : '') }}">
          <a href="{{ route('solicitudes::solicitudes', ['estado' => $estado->id]) }}">{{$estado->nombre}}</a>
        </li>
      @endforeach
    </ul>
    <div class="tab-content">
      @foreach($estados as $estado)
        @if($estadoActivo == $estado->id)
          <div class="tab-pane active">
            <dposs-tabla-solicitudes
              :model='{singular: "reclamo", plural: "reclamos"}'
              :has-modal="false"
              :fields="[]"
              :estado="{{$estadoActivo}}"
            ></dposs-tabla-solicitudes>
          </div>
        @endif
      @endforeach
    </div>
    <!-- /.tab-content -->
  </div>

  </div>
</div>

@endsection
