<!DOCTYPE html>
<html>
<head>
  <title>WEB DPOSS - LIBRE DEUDA</title>
</head>
<body>

  <table>
    <tbody>
      <tr>
        <th colspan="2"><p>Solicitante</p></th>
      </tr>
      <tr>
        <th><p>Apellido</p></th>
        <td><p>{{ $data['solicitante_apellido'] }}</p>
      </tr>
      <tr>
        <th><p>Nombre</p></th>
        <td><p>{{ $data['solicitante_nombre'] }}</p>
      </tr>
      <tr>
        <th><p>Teléfono</p></th>
        <td><p>{{ $data['solicitante_telefono'] }}</p>
      </tr>
      <tr>
        <th><p>Correo electrónico</p></th>
        <td><p>{{ $data['solicitante_email'] }}</p>
      </tr>
    </tbody>
  </table>

</body>
</html>
