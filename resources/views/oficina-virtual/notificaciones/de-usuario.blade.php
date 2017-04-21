@extends('layouts.app')

@section('content-header')
  Notificaciones <small>Oficina Virtual</small>
@endsection

@section('content-breadcrumb')
<li><a href="{{ route('home') }}">Inicio</a></li>
<li><a href="{{ route('oficina-virtual::notificaciones.de-usuario') }}">Notificaciones</a></li>
@endsection


@section('content')

<div class="row">
  <div class="col-xs-12">

    @include('flash::message')

    <panal-box-slot title="Tus notifiaciones" :printable="true">
      <div slot="body">

        <div class="table-responsive">
          <table class="table table-striped table-bordered" id="tabla-cuentas">
            <thead>
              <tr>
                <th>Fecha</th>
                <th>Notifiación</th>
              </tr>
            </thead>
            <tbody>
              @foreach($notificaciones as $notificacion)
              <tr>
                <td>{{ $notificacion->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $notificacion->contenido }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </panal-box-slot>
  </div>
</div>

@endsection
