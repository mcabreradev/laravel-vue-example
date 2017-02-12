<!DOCTYPE html>
<html>
<head>
  <title></title>
  <style>
    .c10% { width: 10%; }
    .c20% { width: 20%; }
    .c25% { width: 25%; }
    .c33% { width: 33%; }
    .c40% { width: 40%; }
    .c45% { width: 45%; }
    .c50% { width: 50%; }
    .c55% { width: 55%; }
    .c60% { width: 60%; }
    .c75% { width: 75%; }
    .c100% { width: 100%; }

    table { width: 100%; }
    td { vertical-align: top; }

    hr {
      border: 1pt solid;
    }

    body {
        font-family: helvetica;
        font-size: 10pt;
    }

    .box {
      border: 1pt solid black;
    }
  </style>
</head>
<body>

  <table>
    <tr>
      <td class="c40%">
        <img src="{{ public_path('img/boleta-pago-logo.png') }}" alt="DPOSS logo">
      </td>
      <td class="c10%"></td>
      <td class="c50%">
        <h1>Reclamo nro {{sprintf("%04d", $solicitud->id)}}</h1>
        @if($solicitud->reclamo_anterior)
          <h2>(nro anterior {{$solicitud->reclamo_anterior}})</h2>
        @endif
      </td>
    </tr>
    <tr><td colspan="3"><p>&nbsp;</p></td></tr>
    <tr>
      <td class="c50%"><strong>Fecha:</strong> {{$solicitud->creado_el->format('d/m/Y H:i:s')}}</td>
      <td class="c50%"><strong>Tipo:</strong> {{$solicitud->tipo->nombre}}</td>
    </tr>
    <tr><td colspan="3"></td></tr>
    <tr>
      <td class="c50%"><strong>Expediente de rentas:</strong> {{$solicitud->expediente}}</td>
      <td class="c50%"><strong>Unidad:</strong> {{$solicitud->unidad}}</td>
    </tr>
    <tr><td colspan="3"></td></tr>
    <tr>
      <td class="c20%"><strong>Sección:</strong> {{$solicitud->seccion}}</td>
      <td class="c20%"><strong>Macizo:</strong> {{$solicitud->macizo}}</td>
      <td class="c20%"><strong>Parcela:</strong> {{$solicitud->parcela}}</td>
      <td class="c20%"><strong>Subparcela:</strong> {{$solicitud->subparcela}}</td>
      <td class="c20%"><strong>Un. funcional:</strong> {{$solicitud->unidad_funcional}}</td>
    </tr>
    <tr><td colspan="3"></td></tr>
    <tr>
      <td class="c45%">
        <div class="box">
          <p>
            <strong>Calle:</strong> {{$solicitud->lugar_calle}}<br>
            <strong>Número:</strong> {{$solicitud->lugar_numero}}<br>
            @if($solicitud->lugar_entre_1 && $solicitud->lugar_entre_2)
            <strong>Entre</strong> {{$solicitud->lugar_entre_1}} <strong>y</strong> {{$solicitud->lugar_entre_2}}<br>
            @endif
            <strong>Barrio:</strong> {{$solicitud->lugar_barrio}}<br>
            <strong>Ciudad:</strong> {{$solicitud->localidad->nombre}}<br>
            <strong>Obs:</strong> {{$solicitud->lugar_observaciones}}
          </p>
        </div>
      </td>
      <td class="c55%">
        <img src="https://maps.googleapis.com/maps/api/staticmap?center={{$solicitud->lat}},{{$solicitud->lng}}&zoom=17&size=400x300&language=es&hl=es&region=AR&markers={{$solicitud->lat}},{{$solicitud->lng}}&key=AIzaSyAa12nfiKAj_Desfk52F3QDOk19TbtCT7k">
      </td>
    </tr>
    <tr>
      <td colspan="3" class="c100%">
        <div class="box">
          <p>
            <strong>Descripción del problema:</strong> {{$solicitud->descripcion}}
          </p>
        </div>
      </td>
    </tr>
    @if($solicitud->solicitante)
      <tr>
        <td colspan="3" class="c100%">
          <div class="box">
            <p>
              <strong>Solicitado por:</strong> {{$solicitud->solicitante->apellido}} {{$solicitud->solicitante->nombre}}<br>
              @if($solicitud->solicitante->celular)
                <strong>Celular:</strong> {{$solicitud->solicitante->celular}}<br>
              @endif
              @if($solicitud->solicitante->telefono)
                <strong>Teléfono:</strong> {{$solicitud->solicitante->telefono}}<br>
              @endif
              @if($solicitud->solicitante->email)
                <strong>Email:</strong> {{$solicitud->solicitante->email}}
              @endif
            </p>
          </div>
        </td>
      </tr>
    @endif
    <tr>
      <td class="c33%"></td>
      <td class="c33%">
        <p style="text-align: right;">
          <p><strong>Firma:</strong></p>
          <p><strong>Aclaración:</strong></p>
        </p>
      </td>
      <td class="c33%"></td>
    </tr>
  </table>
</body>
</html>
