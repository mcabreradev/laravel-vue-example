@extends('layouts.app')

@section('content-header')
  Deudas pendientes <small>Oficina Virtual</small>
@endsection

@section('content-breadcrumb')
<li><a href="{{ route('home') }}">Inicio</a></li>
<li><a href="{{ route('oficina-virtual::deudas-pendientes') }}">Deudas pendientes</a></li>
@endsection


@section('content')

<div class="row">
  <div class="col-xs-12">

    @include('flash::message')

    <dposs-estado-deuda :user="{{ auth()->user() }}" :conexiones="{{ $conexiones }}"/>

  </div>
</div>

@endsection
