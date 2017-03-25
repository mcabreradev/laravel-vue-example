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
        font-size: 11pt;
    }

    .box {
      border: 1pt solid black;
      padding: 10px;
      text-align: center;
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
        <h1>BOLETA DE PAGO</h1>
      </td>
    </tr>
    @if( $boletaPago->saldo <= 0)
      <tr>
        <td colspan="3">
            <p class="box">
              Su factura ya se encuentra paga o está adherida a débido automático. <br>
              No es necesario que imprima ni abone esta boleta de pago.
            </p>
        </td>
      </tr>
    @endif
    <tr>
      <td class="c40%">
        <p>Nombre<br>{{ $boletaPago->ocupante ?: $boletaPago->razon_social }}</p>
        <p><strong>Factura Nº</strong> {{ $boletaPago->factura_tipo }} {{$boletaPago->nro_liq_sp}}</p>
        <p><strong>Período</strong> {{ DateTime::createFromFormat('Ym', $boletaPago->factura_periodo)->format('m/Y') }}</p>
        <p><strong>Unidad Nº</strong> {{ $boletaPago->unidad_numero }}</p>
      </td>
      <td class="c10%"></td>
      <td class="c50%">
        <p><b>Total: ${{ number_format($boletaPago->monto_vencimiento_1, 2, ",", ".") }}</b><br>Primer vencimiento: {{$boletaPago->fecha_vencimiento_1->format('d/m/Y')}}</p>
        <p>Segundo vencimiento: {{ $boletaPago->fecha_vencimiento_2->format('d/m/Y') }}<br>Total: ${{ number_format($boletaPago->monto_vencimiento_2, 2, ",", ".") }}</p>
        <p>Tercer vencimiento: {{ $boletaPago->fecha_vencimiento_3->format('d/m/Y') }}<br>Total: ${{ number_format($boletaPago->monto_vencimiento_3, 2, ",", ".") }}</p>
      </td>
    </tr>
    <tr>
      <td colspan="3">
        <p><strong>Domicilio: </strong> {{ $boletaPago->getDomicilio() }}</p>
      </td>
    </tr>

    <tr>
      <td colspan="3">
        <p>Esta boleta es <b>válida siempre que no supere la tercera fecha de vencimiento</b>, en ese caso sólo podrá efectuar el pago en oficinas de la DPOSS</p>
      </td>
    </tr>
    <tr>
      <td colspan="3">
        <hr>
        <h2>Medios de pago</h2>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <p>Pago fácil</p>
        <p><img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($boletaPago->getCodigoPagoFacil(), 'I25',1,18)}}" /></p>
        <span style="text-align: center; font-size: 8">{{ $boletaPago->getCodigoPagoFacil()}}</span>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <p>Link <br>{{ $boletaPago->getCodigoLink() }}<br><br></p>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <p>Bancos / DPOSS</p>
        <p><tcpdf method="write1DBarcode" params="{{ $codigoDposs }}" /></p>
      </td>
    </tr>
  </table>
</body>
</html>
