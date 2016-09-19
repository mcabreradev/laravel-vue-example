<!DOCTYPE html>
<html>
<head>
  <title>WEB DPOSS - FACTURAS VENCIDAS</title>
</head>
<body>

  <h1>Solicitud de facturas vencidas</h1>

  <h2>Solicitante</h2>
  <p><b>Apellido:</b> {{ $data['solicitante_apellido'] ?: '' }}</p>
  <p><b>Nombre:</b> {{ $data['solicitante_nombre'] ?: '' }}</p>
  <p><b>Teléfono:</b> {{ $data['solicitante_telefono'] ?: '' }}</p>
  <p><b>Correo:</b> {{ $data['solicitante_email'] ?: '' }}</p>

  <h2>Factura</h2>
  <p><b>Domicilio:</b> {{ $data['domicilio'] ?: '' }}</p>
  <p><b>Localidad:</b> {{ $data['localidad'] ?: '' }}</p>
  <p><b>Nomenclatura:</b> {{ $data['nomenclatura'] ?: '' }}</p>
  <p><b>Unidad:</b> {{ $data['unidad'] ?: '' }}</p>
  <p><b>Períodos:</b> {{ $data['periodo'] ?: '' }}</p>
  <p><b>Entrega:</b> {{ $data['entrega'] ?: '' }}</p>

  <h2>Comentarios</h2>
  <p>{{ $data['comentarios'] ?: '' }}</p>

</body>
</html>