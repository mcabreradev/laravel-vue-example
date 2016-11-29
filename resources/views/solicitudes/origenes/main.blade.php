@extends('layouts.app')

@section('content-header')
  Origenes <small>Configuraci&oacute;n</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::origenes') }}">Origenes</a></li>
@endsection


@section('content')

<div id="turnos-tables-container" class="row">
  <div class="col-xs-12">

    @include('flash::message')

    <smart-table
      :model='{singular: "Origen", plural: "Origenes"}'
      :show-tfoot="false"
      :url="'solicitudes/origenes'"
      :fields="['nombre', 'descripcion', 'color']"
    ></smart-table>

  </div>
</div>

@endsection
