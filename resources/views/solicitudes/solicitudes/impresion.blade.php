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
    .c50% { width: 50%; }
    .c50% { width: 50%; }
    .c75% { width: 75%; }
    .c100% { width: 100%; }

    table { width: 100%; }
    td { vertical-align: top; }
    h1, h2, h3, h4, h5, h6, p { margin: 0; padding: 0; }

    hr {
      border: 1pt solid;
      margin: 1em 0;
    }

    body {
        font-family: helvetica;
        font-size: 12pt;
    }

    .box {
      border: 1pt solid black;
      padding: 10px;
    }
  </style>
</head>
<body>

  <table>
    <tr>
      <td class="c40%">
        <img src="{{ public_path('img/boleta-pago-logo.png') }}" alt="DPOSS logo">
      </td>
      <td class="c10%">&nbsp;</td>
      <td class="c50%">
        <h1>Reclamo nro: {{$solicitud->id}}</h1>
      </td>
    </tr>
    <tr><td colspan="3"><p>&nbsp;</p></td></tr>
    <tr><td colspan="3"><p>&nbsp;</p></td></tr>
    <tr>
      <td class="c33%"><strong>Fecha:</strong> {{(new DateTime($solicitud->creado_el))->format('d/m/Y H:i:s')}}</td>
      <td class="c33%"><strong>Tipo:</strong> {{$solicitud->tipo->nombre}}</td>
      <td class="c33%"><strong>Prioridad:</strong> {{$solicitud->prioridad->nombre}}</td>
    </tr>
    <tr>
      <td colspan="3">
        <p><strong>Ubicación:</strong> {{$solicitud->ubicacion}}</p>
      </td>
    </tr>
    <tr>
      <td colspan="3">
        <p>SOLICITANTE</p>
      </td>
    </tr>
    <tr>
      <td colspan="3">
        <p><strong>Descripción del problema:</strong> {{$solicitud->descripcion}}</p>
      </td>
    </tr>
    <tr>
      <td colspan="3">
        <p class="box">
          <strong>Observaciones sobre el trabajo realizado:</strong>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
        </p>
      </td>
    </tr>
    <tr>
      <td class="c33%"></td>
      <td class="c33%">
        <p style="text-align: right;">
          <p>Firma:</p>
          <p>Nombre y apellido:</p>
          <p>Fecha:</p>
        </p>
      </td>
      <td class="c33%"></td>
    </tr>
  </table>
</body>
</html>
