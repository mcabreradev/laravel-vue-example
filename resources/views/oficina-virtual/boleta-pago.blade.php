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
				<h1>BOLETA DE PAGO</h1>
			</td>
		</tr>
		<tr>
      <td class="c40%">
        <p>Nombre<br>{{ $boletaPago->ocupante }}</p>
        <p>Factura Nº<br>{{ $boletaPago->factura_tipo }} {{$boletaPago->nro_liq_sp}}</p>
        <p>Período<br>{{ DateTime::createFromFormat('Ym', $boletaPago->factura_periodo)->format('m/Y') }}</p>
      </td>
      <td class="c10%">&nbsp;</td>
      <td class="c50%">
        <p><b>Total: ${{ number_format($boletaPago->monto_vencimiento_1, 2, ",", ".") }}</b><br>Primer vencimiento: {{$boletaPago->fecha_vencimiento_1->format('d/m/Y')}}</p>
        <p>Segundo vencimiento: {{$boletaPago->fecha_vencimiento_2->format('d/m/Y')}}<br>Total: ${{ number_format($boletaPago->monto_vencimiento_2, 2, ",", ".") }}</p>
        <p>Tercer vencimiento: {{$boletaPago->fecha_vencimiento_3->format('d/m/Y')}}<br>Total: ${{ number_format($boletaPago->monto_vencimiento_3, 2, ",", ".") }}</p>
      </td>
		</tr>

		<tr>
			<td colspan="3">
        <p>Esta boleta es <b>válida siempre que no se haya superado la tercera fecha de vencimiento</b>, en ese caso sólo podrá efectuar el pago en oficinas de la D.P.O.S.S.</p>
      </td>
    </tr>
    <tr>
      <td colspan="3">
        <hr>
				<h2>Medios de pago</h2>
      </td>
    </tr>
    <tr>
      <td colspan="3">
				<p>Pago fácil</p>
				<p><tcpdf method="write1DBarcode" params="{{ $codigoPagoFacil }}" /></p>
      </td>
    </tr>
    <tr>
      <td class="c33%">
				<p>Link</p>
				<p>{{ $boletaPago->getCodigoLink() }}</p>
      </td>
      <td class="c33%">
				<p>Bancos</p>
				<p><tcpdf method="write1DBarcode" params="{{ $codigoDposs }}" /></p>
      </td>
      <td class="c33%">
				<p>Dposs</p>
				<p><tcpdf method="write1DBarcode" params="{{{ $codigoDposs }}}" /></p>
			</td>
		</tr>
	</table>

</body>
</html>
