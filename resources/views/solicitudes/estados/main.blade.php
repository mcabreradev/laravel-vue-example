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

    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Estados</h3>
      </div>

      <div class="box-body">

        <smart-table
          :cols="['nombre', 'descripcion', 'color']"
          :show-tfoot="false"
        ></smart-table>

      </div>
    </div> <!-- .box -->

  </div>
</div>

@endsection
