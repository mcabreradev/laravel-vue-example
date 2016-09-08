<!DOCTYPE html>
<html>
<head>
  <title>WEB DPOSS - LIBRE DEUDA</title>
</head>
<body>

  <h1>Solicitante</h1>
  <p><b>Apellido:</b> {{ $data['solicitante_apellido'] ?: '' }}</p>
  <p><b>Nombre:</b> {{ $data['solicitante_nombre'] ?: '' }}</p>
  <p><b>Teléfono:</b> {{ $data['solicitante_telefono'] ?: '' }}</p>
  <p><b>Correo:</b> {{ $data['solicitante_email'] ?: '' }}</p>

  <h1>Titular</h1>
  <p><b>Nombre:</b> {{ $data['titular_nombre'] ?: '' }}</p>
  <p><b>Documento:</b> {{ $data['titular_documento'] ?: '' }}</p>
  <p><b>Domicilio:</b> {{ $data['domicilio'] ?: '' }}</p>
  <p><b>Expediente:</b> {{ $data['expediente'] ?: '' }}</p>
  <p><b>Unidad:</b> {{ $data['unidad'] ?: '' }}</p>

  <h1>Descripción</h1>
  <p>{{ $data['descripcion'] ?: '' }}</p>

</body>
</html>
