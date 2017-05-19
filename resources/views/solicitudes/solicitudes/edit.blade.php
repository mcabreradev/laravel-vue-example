@extends('layouts.app')

@section('content-header') @endsection


@section('content-breadcrumb') @endsection

@section('content')

  <section class="content-fixed-seccion">
      <h2>Reclamo nro {{$solicitud->id}} <span style="font-size: 45%"><a href="{{ route('solicitudes::solicitudes') }}">Reclamos</a></span></h2>
      <form action="{{route('solicitudes::solicitudes.destroy', ['id' => $solicitud->id])}}" method="POST">
        {!! csrf_field() !!}
        {{ method_field('DELETE') }}

        <button id="btn-delete-solicitud" type="submit" class='btn btn-danger' target="_blank">
          <span class="fa fa-trash"></span> Eliminar reclamo
        </button>

        <div class="btn-group">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="fa fa-print"></span> Imprimir <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li>
              <a href="{{route('solicitudes::solicitudes.imprimir', ['id' => $solicitud->id])}}" target="_blank" rel="noopener noreferrer">
                <span class="fa fa-print"></span> Reclamo
              </a>
            </li>
            <li>
              <a href="{{route('solicitudes::solicitudes.orden-trabajo', ['id' => $solicitud->id])}}" target="_blank" rel="noopener noreferrer">
                <span class="fa fa-wrench"></span> Orden de trabajo
              </a>
            </li>
          </ul>
        </div>

        <button id="btn-guardar-solicitud" class="btn btn-success" type="button">
          <span class="fa fa-check"></span> Guardar cambios
        </button>

        <button class="btn btn-default" type="button" onclick="window.Events.$emit('derivaciones.modals.create.open');">
          <span class="fa fa-paper-plane"></span> Derivar reclamo
        </button>

        <button class="btn btn-default" type="button" onclick="window.Events.$emit('seguimientos.modals.create.open');">
          <span class="fa fa-commenting-o"></span> Crear seguimiento
        </button>
      </form>
  </section>

  <form id="solicitud-edit-form" class="with-content-fixed-seccion" role="form" method="POST" action="{{ route('solicitudes::solicitudes.update', $solicitud->id) }}">
    {!! csrf_field() !!}
    {{ method_field('PUT') }}

    @include('flash::message')

    @if(!$relacionados->isEmpty())
      <div class="alert alert-info">
        Este reclamo está reclacionado con:
        <ul>
          @foreach($relacionados as $rel)
            <li>
              <a href="{{ route('solicitudes::solicitudes.edit', $rel->id) }}">
                {{$rel->id}} {{$rel->reclamo_anterior ? "(ant: {$rel->reclamo_anterior})" : ''}}
              </a>
            </li>
          @endforeach
        </ul>
      </div>
    @endif

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
      open-create-modal-event="seguimientos.modals.create.open"
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
          cancelButtonText: 'Me equivoqué',
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Si, borrar",
          closeOnConfirm: true
        },
        function () {
          form.submit();
        });
      });

      $('#btn-guardar-solicitud').on('click', function(){

        var $form = $('#solicitud-edit-form');

        swal({
          title: "¿Seguro que querés modificar los datos originales?",
          type: "warning",
          showCancelButton: true,
          cancelButtonText: 'Me equivoqué',
          confirmButtonColor: "#008d4c",
          confirmButtonText: "Si, modificarlo",
          closeOnConfirm: true
        },
        function () {
          $form.submit();
        });
      });
    })(window.jQuery);
  </script>
@endsection

