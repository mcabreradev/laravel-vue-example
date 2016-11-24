@extends('layouts.app')

@section('content-header')
  Estados <small>Configuraci&oacute;n</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::estados') }}">Estados</a></li>
@endsection


@section('content')

<div id="turnos-tables-container" class="row">
  <div class="col-xs-12">

    @include('flash::message')

    <smart-table
      :model='"Estado"'
      :show-tfoot="false"
      :url="'solicitudes/estados'"
      :cols="['nombre', 'descripcion', 'color']"
    ></smart-table>

  </div>
</div>

@endsection
