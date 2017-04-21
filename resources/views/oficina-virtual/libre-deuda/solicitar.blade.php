@extends('layouts.app')

@section('content-header')
  Libre deuda <small>Oficina Virtual</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('home') }}">Inicio</a></li>
<li><a href="{{ route('oficina-virtual::solicitar-libre-deuda') }}">Libre deuda</a></li>
@endsection


@section('content')

<div class="row">
  <div class="col-xs-12">

    @include('flash::message')
    <dposs-solicitar-libre-deuda :conexiones="{{ $conexiones }}" :usuario="{{ auth()->user() }}" />

  </div>
</div>

@endsection
