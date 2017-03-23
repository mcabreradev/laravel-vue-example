<!DOCTYPE html>
<html>
<head>
  <title>WEB DPOSS - LIBRE DEUDA</title>
</head>
<body>

  <h1>Solicitud de libre deuda</h1>

  <h2>Solicitante</h2>
  <p><b>Apellido:</b> {{ isset($data['solicitante_apellido']) ? $data['solicitante_apellido'] : '' }}</p>
  <p><b>Nombre:</b> {{ isset($data['solicitante_nombre']) ? $data['solicitante_nombre'] : '' }}</p>
  <p><b>Teléfono:</b> {{ isset($data['solicitante_telefono']) ? $data['solicitante_telefono'] : '' }}</p>
  <p><b>Correo:</b> {{ isset($data['solicitante_email']) ? $data['solicitante_email'] : '' }}</p>

  <h2>Titular</h2>
  <p><b>Nombre:</b> {{ isset($data['titular_nombre']) ? $data['titular_nombre'] : '' }}</p>
  <p><b>Documento:</b> {{ isset($data['titular_documento']) ? $data['titular_documento'] : '' }}</p>

  <h2>Factura</h2>
  <p><b>Domicilio:</b> {{ isset($data['domicilio']) ? $data['domicilio'] : '' }}</p>
  <p><b>Localidad:</b> {{ isset($data['localidad']) ? $data['localidad'] : '' }}</p>
  <p><b>Nomenclatura:</b> {{ isset($data['nomenclatura']) ? $data['nomenclatura'] : '' }}</p>
  <p><b>Unidad:</b> {{ isset($data['unidad']) ? $data['unidad'] : '' }}</p>

  <h2>Descripción</h2>
  <p>{{ isset($data['descripcion']) ? $data['descripcion'] : '' }}</p>

</body>
</html>
