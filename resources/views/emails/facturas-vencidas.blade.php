<!DOCTYPE html>
<html>
<head>
  <title>WEB DPOSS - FACTURAS VENCIDAS</title>
</head>
<body>

  <h1>Solicitud de facturas vencidas</h1>

  <h2>Solicitante</h2>
  <p><b>Nombre completo:</b> {{ isset($data['solicitante_apellido']) ? $data['solicitante_apellido'] : '' }} {{ isset($data['solicitante_nombre']) ? $data['solicitante_nombre'] : '' }}</p>
  <p><b>Teléfono:</b> {{ isset($data['solicitante_telefono']) ? $data['solicitante_telefono'] : '' }}</p>
  <p><b>Correo:</b> {{ isset($data['solicitante_email']) ? $data['solicitante_email'] : '' }}</p>

  <h2>Factura</h2>
  <p><b>Domicilio:</b> {{ isset($data['domicilio']) ? $data['domicilio'] : '' }}</p>
  <p><b>Localidad:</b> {{ isset($data['localidad']) ? $data['localidad'] : '' }}</p>
  <p><b>Nomenclatura:</b> {{ isset($data['nomenclatura']) ? $data['nomenclatura'] : '' }}</p>
  <p><b>Unidad:</b> {{ isset($data['unidad']) ? $data['unidad'] : '' }}</p>
  <p><b>Períodos:</b> {{ isset($data['periodo']) ? $data['periodo'] : '' }}</p>
  <p><b>Entrega:</b> {{ isset($data['entrega']) ? $data['entrega'] : '' }}</p>

  <h2>Comentarios</h2>
  <p>{{ isset($data['comentarios']) ? $data['comentarios'] : '' }}</p>

</body>
</html>
