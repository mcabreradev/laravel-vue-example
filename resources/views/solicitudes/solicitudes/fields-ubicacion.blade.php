{!! csrf_field() !!}

<div class="row">
  <div class="col-md-6 col-xs-12">

    <div class="form-group">
      <label for="expediente">Expediente</label>
      <input class="form-control" type="text" name="expediente" id="expediente" value="{{ old('expediente', $solicitud->expediente) }}">
    </div>

    <div class="form-group">
      <label for="unidad">Número de Unidad</label>
      <input class="form-control" type="text" name="unidad" id="unidad" value="{{ old('unidad', $solicitud->unidad) }}">
    </div>

    <div class="form-group">
      <label for="nomenclatura">Nomenclatura (sección, mazico, parcela)</label>
      <input class="form-control" type="text" name="nomenclatura" id="nomenclatura" value="{{ old('nomenclatura', $solicitud->nomenclatura) }}">
    </div>

    <div class="form-group">
      <label for="lugar_calle">Calle</label>
      <input class="form-control" type="text" name="lugar_calle" id="lugar_calle" value="{{ old('lugar_calle', $solicitud->lugar_calle) }}">
    </div>

    <div class="form-group">
      <label for="lugar_numero">Número</label>
      <input class="form-control" type="text" name="lugar_numero" id="lugar_numero" value="{{ old('lugar_numero', $solicitud->lugar_numero) }}">
    </div>

    <div class="form-group">
      <label for="lugar_entre_1">Entre</label>
      <input class="form-control" type="text" name="lugar_entre_1" id="lugar_entre_1" value="{{ old('lugar_entre_1', $solicitud->lugar_entre_1) }}">
    </div>

    <div class="form-group">
      <label for="lugar_entre_2">Y</label>
      <input class="form-control" type="text" name="lugar_entre_2" id="lugar_entre_2" value="{{ old('lugar_entre_2', $solicitud->lugar_entre_2) }}">
    </div>

    <div class="form-group">
      <label for="lugar_barrio">Barrio</label>
      <input class="form-control" type="text" name="lugar_barrio" id="lugar_barrio" value="{{ old('lugar_barrio', $solicitud->lugar_barrio) }}">
    </div>

    <div class="form-group">
      <label for="localidad_id">Localidad</label>
      <select class="form-control" id="localidad_id" name="localidad_id" style="width: 100%">
        @foreach($localidades as $localidad)
          @if( collect($solicitud->localidad_id)->contains($localidad->id))
            <option value="{{ $localidad->id }}" selected>{{ $localidad->nombre }}</option>
          @else
            <option value="{{ $localidad->id }}">{{ $localidad->nombre }}</option>
          @endif
        @endforeach
      </select>
    </div>
  </div>

  <div class="col-md-6 col-xs-12">

    <div class="form-group text-center">
      <div id="mapa-ubicacion" style="width: 100%; height: 300px"></div>
    </div>

    <div class="form-group">
      <button id="inferir-coordenadas-btn" type="button" class="btn btn-primary" data-loading-text="Infiriendo...">
        <span class="fa fa-map-marker"></span> Inferir coordenadas
      </button>
    </div>

    <div class="form-group">
      <label for="lat">Latitud</label>
      <input class="form-control" type="text" name="lat" id="lat" value="{{ old('lat', $solicitud->lat) }}">
    </div>

    <div class="form-group">
      <label for="lng">Longitud</label>
      <input class="form-control" type="text" name="lng" id="lng" value="{{ old('lng', $solicitud->lng) }}">
    </div>

    <div class="form-group">
      <label for="lugar_observaciones">Obervaciones</label>
      <textarea rows="3" class="form-control" id="lugar_observaciones" name="lugar_observaciones">{{ old('lugar_observaciones', $solicitud->lugar_observaciones) }}</textarea>
    </div>
  </div>
</div>

@section('body-scripts')
  @parent

  @include('common.maps')
  <script>
    (function($, L){
      'use strict';

      // inicializo variables
      var $lat     = $('#lat'),
          $lng     = $('#lng'),
          lat      = $lat.val(),
          lng      = $lng.val(),
          map      = null,
          marker   = null,
          baseMaps = {},
          geocoder = new google.maps.Geocoder();

      // ajusto valores de lat y lng tanto en varaibles como en inputs
      if (lat == '') {
        lat = -54.8033601;
        $lat.val(lat);
      }

      if (lng == '') {
        lng = -68.3172124;
        $lng.val(lng);
      }

      // creo mapa centrado en Ushuaia
      map = new L.Map('mapa-ubicacion', {scrollWheelZoom: false})
        .setView([lat, lng], 15);

      // agrego marker que servira para ajustar las coordenadas
      marker = L.marker([lat, lng], {draggable:'true'});
      marker.addTo(map);

      // evento para actualizar las coordenadas al arrastrarse el marker
      marker.on('dragend', function(event){
        var draggedMarker = event.target;
        var position      = draggedMarker.getLatLng();
        var latlng        = new L.LatLng(position.lat, position.lng);

        draggedMarker.setLatLng(latlng,{draggable:'true'});
        map.panTo(latlng)

        $lat.val(position.lat);
        $lng.val(position.lng);
      });

      // eventos para actualizarce el marker al completar los inputs
      $('#lat, #lng').on('change', function(){
        var latlng = new L.LatLng($lat.val(), $lng.val());

        marker.setLatLng(latlng,{draggable:'true'});
        map.panTo(latlng)
      });

      // capas disponibles
      baseMaps = {
        'Google carretera': new L.Google('ROADMAP'),
        'Google satelital': new L.Google('HYBRID')
      };
      L.control.layers(baseMaps, {}).addTo(map);

      // seteo la capa predeterminada
      map.addLayer(baseMaps['Google carretera']);

      // evento para inferir las coordenadas a partir de la calle
      $('#inferir-coordenadas-btn').on('click', function(){
        var $btn    = $(this),
            address = '';

        $btn.button('loading');

        var ubicacionData = {
          calle: $('#lugar_calle').val(),
          numero: $('#lugar_numero').val(),
          entre1: $('#lugar_entre_1').val(),
          entre2: $('#lugar_entre_2').val()
        };

        // intento por calle + numero o por entre1 + entre2
        if (ubicacionData.calle.length) {
          address += ubicacionData.calle + ' ' + ubicacionData.numero;
        }
        else {
          address += ubicacionData.entre1 + ' y ' + ubicacionData.entre2;
        }

        // agrego la ciudad
        address += ', ' + $('#localidad_id option:selected').text();

        // completo con provincia y pais
        address += ', Tierra del Fuego, Argentina';

        // servicio de google para inferir un punto a partir de la direccion
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === google.maps.GeocoderStatus.OK) {

            // obtengo las posiciones
            var latlng = new L.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());

            // cambio el marker y centro el mapa
            marker.setLatLng(latlng,{draggable:'true'});
            map.panTo(latlng);

            // actualizo los inputs
            $lat.val(results[0].geometry.location.lat());
            $lng.val(results[0].geometry.location.lng());

            $btn.button('reset');

          } else {
            console.error('Geocode was not successful for the following reason: ' + status);
            $btn.button('reset');
          }
        });
      });

    })(window.jQuery, window.L);
  </script>

@endsection
