{!! csrf_field() !!}

<div class="row">
  <div class="col-md-6 col-xs-12">

    <div class="form-group">
      <label for="lugar_calle">Calle</label>
      <input class="form-control" type="text" name="lugar_calle" id="lugar_calle" value="{{ old('lugar_calle', $solicitud->lugar_calle) }}">
    </div>

    <div class="form-group">
      <label for="lugar_numero">Nro</label>
      <input class="form-control" type="text" name="lugar_numero" id="lugar_numero" value="{{ old('lugar_numero', $solicitud->lugar_numero) }}">
    </div>

    <div class="form-group">
      <label for="lugar_observaciones">Obervaciones</label>
      <textarea class="form-control" id="lugar_observaciones" name="lugar_observaciones">{{ old('lugar_observaciones', $solicitud->lugar_observaciones) }}</textarea>
    </div>

    <div class="form-group">
      <label for="lugar_entre_1">Entre</label>
      <input class="form-control" type="text" name="lugar_entre_1" id="lugar_entre_1" value="{{ old('lugar_entre_1', $solicitud->lugar_entre_1) }}">
    </div>

    <div class="form-group">
      <label for="lugar_entre_2">Y</label>
      <input class="form-control" type="text" name="lugar_entre_2" id="lugar_entre_2" value="{{ old('lugar_entre_2', $solicitud->lugar_entre_2) }}">
    </div>

  </div>
  <div class="col-md-6 col-xs-12">

    <div class="form-group">
    <!--  <panal-map
       height="300px"
       :zoom="{{$solicitud->id ? 10 : 8}}"
       :lat="{{ old('lat', $solicitud->lat) }}"
       :lng="{{ old('lng', $solicitud->lng) }}">
     </panal-map> -->
    </div>

  </div>
</div>
