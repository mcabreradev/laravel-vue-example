<div class="table-responsive">
  <table class="turnos table table-striped">
    <thead>
      <th>Fecha</th>
      <th>Hora</th>
      <th>Actividad</th>
      <th>Usuario</th>
      <th>DNI</th>
      <th>Acciones</th>
    </thead>
    <tbody>
      @foreach($turnos as $turno)
      <tr>
        <td>{{ $turno->fecha }}</td>
        <td>{{ $turno->hora }}</td>
        <td>{{ $turno->actividad->nombre }}</td>
        <td>{{ $turno->usuario->getNombreCompleto() }}</td>
        <td>{{ $turno->usuario->documento }}</td>
        <td>
          <a href="#" class="btn btn-primary btn-sm" title="Validar atención">
            <span class="fa fa-check"></span>
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
