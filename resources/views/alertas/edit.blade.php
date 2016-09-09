@extends('layouts.app')

@section('content-header')
Mapa de alertas
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('alertas::index') }}">Mapa de alertas</a></li>
@endsection


@section('content')

<div class="row">
  <div class="col-xs-12">

    <div class="box">
      <div class="box-header with-border">
        <h1>Editando alerta</h1>
        @include('flash::message')
      </div>

      <div class="box-body">

        <div class="row">
          <div class="col-xs-12 col-sm-8">
            <p>Para modificar el estado de un barrio haga click en él</p>

            <div id="indicador-barrio" style="display: none;position: absolute; top: 10px; left: 50px; z-index: 1002; background-color: white; padding: 8px; border: 1px solid #ccc;">
              <strong>Barrio: </strong><span id="indicador-barrio-content"></span>
            </div>
            <div id="map" style="width: 100%; height: 300px">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4">
            <form id="store-alerta" method="POST" action="{{ route('alertas::store') }}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <input type="hidden" id="detalle-barrios" name="detalle-barrios">

              <div class="form-group">
                <label for="inicia_el" class="form-label">Inicio</label>
                <input name="inicia_el" type="datetime" class="form-control" id="inicia_el" required value="{{ $alerta->inicia_el->toDateTimeString() }}">
              </div>

              <div class="form-group">
                <label for="duracion" class="form-label">Vigencia del alerta (en horas)</label>
                <input name="duracion" type="number" class="form-control" id="duracion" required>
              </div>

              <div class="form-group">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea id="descripcion" name="descripcion" class="form-control" rows="5">{{ $alerta->descripcion }}</textarea>
              </div>

              <div class="form-group">
                <button class="btn btn-success pull-right" type="submit">
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

      // creo mapa centrado en Ushuaia
      var map = new L.Map('map', {center: new L.LatLng(-54.8033601,-68.3172124), zoom: 13});
      // capa de google
      var ggl = new L.Google('ROADMAP');

      // agrego la capa de google
      map.addLayer(ggl);

      // agrego boton para seleccionar capas bases
      map.addControl(new L.Control.Layers({
        'Google Roadmap': ggl,
        'Google Hybrid': new L.Google('HYBRID'),
        'OSM': new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
      }, {}));

      // obtengo capa de creacion
      $.getJSON('{{ route('alertas::edit.layer', $alerta->id) }}')
        .done(function(data){

          var layer = L.geoJson(data, {
            onEachFeature: onEachFeature
          }).addTo(map);

        });

      // pogo div dentro del mapa
      $('#indicador-barrio').appendTo('#map');

      // submit del formulario
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

      /**
       * Estilos predeterminados
       * @param  {[type]} feature [description]
       * @return {[type]}         [description]
       */
      function featureDefaultStyle(feature) {
        switch (feature.properties.estado.id) {
          case 1: return {color: 'white', fillColor: "#59850B", weight: 2, dashArray: '3', fillOpacity: 0.4};
          case 2: return {color: 'white', fillColor: "#F8C540", weight: 2, dashArray: '3', fillOpacity: 0.6};
          default: return {color: 'white', fillColor: "#C73926", weight: 2, dashArray: '3', fillOpacity: 0.6};
        }
      }

      /**
       * Estilos al pasar por encima de un poligono
       * @param  {[type]} feature [description]
       * @return {[type]}         [description]
       */
      function featureHighlightedStyle(feature) {
        switch (feature.properties.estado.id) {
          case 1: return {color: 'white', fillColor: "#59850B", weight: 2, dashArray: '3', fillOpacity: 0.6};
          case 2: return {color: 'white', fillColor: "#F8C540", weight: 2, dashArray: '3', fillOpacity: 0.8};
          default: return {color: 'white', fillColor: "#C73926", weight: 2, dashArray: '3', fillOpacity: 0.8};
        }
      }

      /**
       * Eventos para los poligonos
       * @param  {[type]} feature [description]
       * @param  {[type]} layer   [description]
       * @return {[type]}         [description]
       */
      function onEachFeature(feature, layer) {
        // Load the default style.
        layer.setStyle(featureDefaultStyle(feature));

        // Create a self-invoking function that passes in the layer
        // and the properties associated with this particular record.
        (function(layer, feature) {
          // Create a mouseover event
          layer.on('mouseover', function(e) {
            // Change the style to the highlighted version
            layer.setStyle(featureHighlightedStyle(feature));

            $('#indicador-barrio-content').html(feature.properties.nombre);
            $('#indicador-barrio').show();
          });

          // Create a mouseout event that undoes the mouseover changes
          layer.on('mouseout', function(e) {
            // Start by reverting the style back
            layer.setStyle(featureDefaultStyle(feature));
            $('#indicador-barrio').hide();
          });

          layer.on('click', function(e) {
            if (feature.properties.estado.id === 3) {
              feature.properties.estado.id = 1;
            } else {
              feature.properties.estado.id++;
            }

            layer.setStyle(featureHighlightedStyle(feature));
          });

          // Close the "anonymous" wrapper function, and call it while passing
          // in the variables necessary to make the events work the way we want.
        })(layer, feature);
      }
    })(window.jQuery, window.L);
  </script>

@endsection
