@extends('layouts.app')

@section('content-header')
Mapa de alertas
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('alertas::index') }}">Alertas</a></li>
@endsection


@section('content')

<div class="row">
  <div class="col-xs-12">

    <div class="box">
      <div class="box-header with-border">
        <h1>Nueva alerta</h1>
        @include('flash::message')
      </div>

      <div class="box-body">

        <div class="row">
          <div class="col-xs-12 col-sm-8">
            <p>Para modificar el estado de un barrio haga click en él</p>
            <div id="map" style="width: 100%; height: 300px"></div>
          </div>
          <div class="col-xs-12 col-sm-4">
            <form id="store-alerta" method="POST" action="{{ route('alertas::store') }}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <input type="hidden" id="detalle-barrios" name="detalle-barrios">

              <div class="form-group">
                <label for="inicia_el" class="form-label">Inicio</label>
                <input name="inicia_el" type="datetime" class="form-control" id="inicia_el" required>
              </div>

              <div class="form-group">
                <label for="duracion" class="form-label">Vigencia del alerta (en horas)</label>
                <input name="duracion" type="number" class="form-control" id="duracion" required>
              </div>

              <div class="form-group">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea id="descripcion" name="descripcion" class="form-control" rows="5"></textarea>
              </div>

              <div class="form-group">
                <button class="btn btn-success" type="submit">
                  <span class="fa fa-check"></span> Guardar
                </button>
              </div>

            </form>
          </div>
        </div>
      </div>

      <div class="box-footer">

      </div>
    </div> <!-- .box -->

  </div>
</div>

@endsection

@section('body-scripts')
@parent

  @include('common.maps')

  <script>
    (function($, L){
      'use strict';

      function featureStyle(feature) {
        switch (feature.properties.estado.id) {
          case 1: return {color: 'white', fillColor: "#59850B", weight: 2, dashArray: '3', fillOpacity: 0.4};
          case 2: return {color: 'white', fillColor: "#F8C540", weight: 2, dashArray: '3', fillOpacity: 0.6};
          default: return {color: 'white', fillColor: "#C73926", weight: 2, dashArray: '3', fillOpacity: 0.6};
        }
      }

      var map = new L.Map('map', {center: new L.LatLng(-54.8033601,-68.3172124), zoom: 13});
      var ggl = new L.Google('ROADMAP');
      map.addLayer(ggl);
      map.addControl(new L.Control.Layers({
        'Google Roadmap': ggl,
        'Google Hybrid': new L.Google('HYBRID'),
        'OSM': new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
      }, {}));

      $.getJSON('{{ route('alertas::create.layer') }}')
        .success(function(data){

          var layer = L.geoJson(data, {
            style: featureStyle
          }).addTo(map);

          layer.on('click', function(event){

            if (event.layer.feature.properties.estado.id === 3) {
              event.layer.feature.properties.estado.id = 1;
            } else {
              event.layer.feature.properties.estado.id++;
            }

            layer.setStyle(featureStyle);
          });
        });

      $('#store-alerta').on('submit', function(event){
        event.preventDefault();
        var detalleBarrios = [];

        map.eachLayer(function(layer) {
          // me quedo con los barrios
          if (layer.hasOwnProperty('feature')) {
            detalleBarrios.push(layer.feature.properties);
          }
        });

        $('#detalle-barrios').val(JSON.stringify(detalleBarrios));

        event.target.submit();
      });

    })(window.jQuery, window.L);
  </script>

@endsection
