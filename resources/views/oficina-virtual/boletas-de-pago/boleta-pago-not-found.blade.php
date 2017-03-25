<!DOCTYPE html>
<html>
<head>
  <title>Boleta no encontrada</title>

  <style>
    html, body {
      height: 100%;
    }

    body {
      margin: 0;
      padding: 0;
      width: 100%;
      display: table;
      font: sans-serif;
    }

    .container {
      text-align: center;
      vertical-align: middle;
      margin-top: 7vh;
    }

    .content {
      text-align: center;
      display: inline-block;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="content">
      <img src="{{ asset('img/dposs-logo.png') }}"><br><br>
      <p style="font-size: 3vh;">No encontramos una boleta de pago con los datos ingresados</p>
    </div>
  </div>
</body>
</html>
