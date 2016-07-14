@extends('layouts.app')

@section('content-header')
Nivel de agua en plantas
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('plantas.niveles.index') }}"> Plantas</a></li>
@endsection


@section('content')

<div class="row">
  <div class="col-xs-12">

    <div class="box">
      <div class="box-header with-border">
        <h1>Registros históricos de nivel de agua en plantas</h1>
        @include('flash::message')
      </div>

      <div class="box-body">

        <div class="row">
          <div class="col-xs-12">
            <button class="btn btn-primary pull-right" type="button" onclick="$('#crear-registro-modal').modal('show');">
              <span class="fa fa-plus"></span> Nuevo registro
            </button>
          </div>
        </div>

        @if($registros->isEmpty())
          <div class="well text-center">No hay registros históricos de niveles de agua en plantas</div>
        @else
          @include('plantas.niveles.index-registros-table')
        @endif
      </div>

      <div class="box-footer">

      </div>
    </div> <!-- .box -->

  </div>
</div>

<form method="POST" action="{{ route('plantas.niveles.registros.store') }}">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">

  <div id="crear-registro-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Nuevo registro</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="fecha-registro" class="control-label">Fecha de medición</label>
            <input id="fecha-registro" name="fecha" type="date" class="form-control" value="{{ date('Y-m-d') }}">
          </div>

          <div class="form-group">
            <label for="nivel-select" class="control-label">Elija un nivel para hoy</label>
            <select id="nivel-select" name="nivel" class="form-control">
              @foreach($niveles as $nivel)
                <option value="{{ $nivel->id }}">{{ $nivel->titulo }}</option>
              @endforeach
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">
            <span class="glyphicon glyphicon-ok"></span> Guardar
          </button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</form>
@endsection
