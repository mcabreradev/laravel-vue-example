<!DOCTYPE html>
<html>
<head>
  <title>WEB DPOSS - LIBRE DEUDA</title>
</head>
<body>

  <h1>Solicitud de libre deuda</h1>

  <h2>Solicitante</h2>
  <p><b>Apellido:</b> {{ $data['solicitante_apellido'] ?: '' }}</p>
  <p><b>Nombre:</b> {{ $data['solicitante_nombre'] ?: '' }}</p>
  <p><b>Teléfono:</b> {{ $data['solicitante_telefono'] ?: '' }}</p>
  <p><b>Correo:</b> {{ $data['solicitante_email'] ?: '' }}</p>

  <h2>Titular</h2>
  <p><b>Nombre:</b> {{ $data['titular_nombre'] ?: '' }}</p>
  <p><b>Documento:</b> {{ $data['titular_documento'] ?: '' }}</p>

  <h2>Factura</h2>
  <p><b>Domicilio:</b> {{ $data['domicilio'] ?: '' }}</p>
  <p><b>Localidad:</b> {{ $data['localidad'] ?: '' }}</p>
  <p><b>Nomenclatura:</b> {{ $data['nomenclatura'] ?: '' }}</p>
  <p><b>Unidad:</b> {{ $data['unidad'] ?: '' }}</p>

  <h2>Descripción</h2>
  <p>{{ $data['descripcion'] ?: '' }}</p>

</body>
</html>
