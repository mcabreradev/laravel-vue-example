@extends('layouts.app')

@section('content-header')
  Facturas adeudadas <small>Oficina Virtual</small>
@endsection

@section('content-breadcrumb')
<li><a href="{{ route('home') }}">Inicio</a></li>
<li><a href="{{ route('oficina-virtual::facturas-adeudadas') }}">Facturas adeudadas</a></li>
@endsection


@section('content')

<div class="row">
  <div class="col-xs-12">

    @include('flash::message')

    <dposs-facturas-adeudadas :user="{{ auth()->user() }}" :conexiones="{{ $conexiones }}"/>

  </div>
</div>

@endsection
