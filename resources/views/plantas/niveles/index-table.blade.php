<div class="table-responsive">
  <table class="table">
    <thead>
      <th>Título</th>
      <th>Etiqueta</th>
      <th>Acciones</th>
    </thead>
    <tbody>
      @foreach($niveles as $nivel)
      <tr>
        <td>{{ $nivel->titulo }}</td>
        <td>{{ $nivel->etiqueta }}</td>
        <td>
          <div class='btn-group'>
            <a href="#" class='btn btn-success btn-sm' title="Editar">
              <span class="fa fa-pencil"></span>
            </a>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
