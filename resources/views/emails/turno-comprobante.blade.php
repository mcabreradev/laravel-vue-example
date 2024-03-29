<!DOCTYPE html>
<html>
<head>
  <title>DPOSS - TURNO</title>
</head>
<body>

  <h1>Comprobante turno para {{ $turno->actividad->nombre }}</h1>

  <h2>Te esperamos el {{ $turno->fecha->format('d/m/Y') }} a las {{ $turno->hora }}</h2>

  <h3>Solicitante</h3>
  <p><b>Apellido:</b> {{ $turno->usuario->apellido }}</p>
  <p><b>Nombre:</b> {{ $turno->usuario->nombre }}</p>
  <p><b>DNI/CUIT:</b> {{ $turno->usuario->documento }}</p>
  <p><b>Teléfono:</b> {{ $turno->usuario->movil }}</p>
  <p><b>Correo:</b> {{ $turno->usuario->email }}</p>

</body>
</html>
