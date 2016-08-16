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
        <h1>Alertas</h1>
        @include('flash::message')
      </div>

      <div class="box-body">

        <div class="row">
          <div class="col-xs-12">
            <a class="btn btn-default" href="{{ route('alertas::estados.index') }}">
              <span class="fa fa-info-circle"></span> Ver estados definidos
            </a>
            <a class="btn btn-primary pull-right" href="{{ route('alertas::create') }}">
              <span class="fa fa-plus"></span> Nueva alerta
            </a>
          </div>
        </div>
        <br>

        <div class="row">
          <div class="col-xs-12">
            <button id="btn-vigentes" class="btn btn-primary" type="button">Vigentes</button>
            <button id="btn-futuras" class="btn btn-default" type="button">Futuras</button>
            <div id="map" style="width: 100%; height: 300px"></div>
          </div>
        </div>


        @if($alertas->isEmpty())
          <div class="well text-center">No se cargaron alertas</div>
        @else
          @include('alertas.index-table')
        @endif
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

      var map = new L.Map('map', {center: new L.LatLng(-54.8033601,-68.3172124), zoom: 13});
      var ggl = new L.Google('ROADMAP');
      var layers = {vigentes: null, futuras: null};

      function featureStyle(feature) {
        switch (feature.properties.estado.id) {
          case 1: return {color: 'white', fillColor: "#59850B", weight: 2, dashArray: '3', fillOpacity: 0.4};
          case 2: return {color: 'white', fillColor: "#F8C540", weight: 2, dashArray: '3', fillOpacity: 0.6};
          default: return {color: 'white', fillColor: "#C73926", weight: 2, dashArray: '3', fillOpacity: 0.6};
        }
      }

      $('#btn-vigentes').on('click', function() {
        map.removeLayer(layers.futuras);
        map.addLayer(layers.vigentes);

        $('#btn-futuras').removeClass('btn-primary')
          .addClass('btn-default');

        $(this).removeClass('btn-default')
          .addClass('btn-primary');
      });

      $('#btn-futuras').on('click', function() {
        map.removeLayer(layers.vigentes);
        map.addLayer(layers.futuras);

        $('#btn-vigentes').removeClass('btn-primary')
          .addClass('btn-default');

        $(this).removeClass('btn-default')
          .addClass('btn-primary');
      });

      // add control for tile layers
      map.addControl(new L.Control.Layers({
        'Google Roadmap': ggl,
        'Google Hybrid': new L.Google('HYBRID'),
        'OSM': new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
      }, {}));

      // default tile layer
      map.addLayer(ggl);

      $.getJSON('{{ route('api::v1::alertas::vigentes.layer') }}')
        .success(function(data) {
          layers.vigentes = L.geoJson(data, {
            style: featureStyle
          }).addTo(map);

          layers.vigentes.on('click', function(event) {
            console.log(event.layer.feature.properties);
          });
        });

      $.getJSON('{{ route('api::v1::alertas::futuras.layer') }}')
        .success(function(data) {
          layers.futuras = L.geoJson(data, {
            style: featureStyle
          });

          layers.futuras.on('click', function(event) {
            console.log(event.layer.feature.properties);
          });
        });

    })(window.jQuery, window.L);
  </script>

@endsection
