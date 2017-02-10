@extends('layouts.app')

@section('content-header')
  Reclamo Nro {{$solicitud->id}}
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('solicitudes::solicitudes') }}">Reclamos</a></li>
@endsection

@section('content')

  <div class="row">
    <div class="col-xs-12">
      <form action="{{route('solicitudes::solicitudes.destroy', ['id' => $solicitud->id])}}" method="POST">
        {!! csrf_field() !!}
        {{ method_field('DELETE') }}

        <a role="button" class='btn btn-default' href="{{route('solicitudes::solicitudes.imprimir', ['id' => $solicitud->id])}}" target="_blank">
          Imprimir reclamo <span class="fa fa-print"></span>
        </a>

        <a role="button" class='btn btn-default' href="{{route('solicitudes::solicitudes.imprimir', ['id' => $solicitud->id])}}" target="_blank">
          Imprimir orden de trabajo <span class="fa fa-print"></span>
        </a>

        <button id="btn-delete-solicitud" type="submit" class='btn btn-danger' target="_blank">
          Eliminar reclamo <span class="fa fa-trash"></span>
        </button>
      </form>
      <br>
      <br>
      <br>
    </div>
  </div>

  <form role="form" method="POST" action="{{ route('solicitudes::solicitudes.update', $solicitud->id) }}">
    {!! csrf_field() !!}
    {{ method_field('PUT') }}

    @include('flash::message')

    @include('solicitudes.solicitudes.fields-datos-generales')

    <panal-box-slot title="Ubicación">
      <div slot="body">
        @include('solicitudes.solicitudes.fields-ubicacion')
      </div>
    </panal-box-slot>

    <panal-box-slot title="Reclamante">
      <div slot="body">
        @include('solicitudes.solicitudes.fields-solicitante')
      </div>
      <panal-indicator></panal-indicator>
    </panal-box-slot>

    <panal-box-slot title="Datos adicionales">
      <div slot="body">
        @include('solicitudes.solicitudes.fields-datos-adicionales')
      </div>
      <panal-indicator></panal-indicator>

      <div slot="footer">
        @include('common.form-buttons', ['route' => 'solicitudes::solicitudes'])
      </div>
    </panal-box-slot>

    <dposs-derivaciones-tabla
      title="Derivaciones"
      :model='{singular: "derivación", plural: "derivaciones"}'
      :url="{simple: 'solicitudes.derivaciones', doble:'solicitudes::derivaciones'}"
      :where="{id: {{ $solicitud->id }} }"
      :fields="[
        {name: 'derivado_el', title: 'Fecha', type: 'datetime', required: true},
        {name: 'observaciones', title:'Observación', type: 'textarea'},
        {name: 'solicitud_id', type: 'hidden', value: {{$solicitud->id}} }
        ]"
    ></dposs-derivaciones-tabla>

    <panal-table title="Seguimientos"
      :model='{singular: "seguimiento", plural: "seguimientos"}'
      :url="{
        index: 'solicitudes::seguimientos.por-solicitud',
        store: 'solicitudes::seguimientos.store',
        update: 'solicitudes::seguimientos.update',
        destroy: 'solicitudes::seguimientos.destroy'
      }"
      :has-modal="true"
      :where="{solicitudId: {{ $solicitud->id }} }"
      :fields="[
        {name: 'generado_el', title: 'Fecha', type: 'datetime', required: true},
        {name: 'descripcion', title:'Descripción', type: 'textarea'},
        {name: 'solicitud_id', type: 'hidden', value: {{$solicitud->id}} }
        ]"
    ></panal-table>

  </form>
@endsection

@section('body-scripts')
  @parent
  <script type="text/javascript">
    (function($){

      $('#btn-delete-solicitud').on('click', function(event){
        event.preventDefault();

        var form = $(this).parent('form')[0];

        swal({
          title: "Estás seguro/a?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Si, borrar",
          closeOnConfirm: true
        },
        function () {
          form.submit();
        });
      });
    })(window.jQuery);
  </script>
@endsection

