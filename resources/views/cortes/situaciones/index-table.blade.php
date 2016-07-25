<div class="table-responsive">
  <table class="table table-striped" id="situaciones-table">
    <thead>
      <th>Inicio</th>
      <th>Fin</th>
      <th>Descripción</th>
      <th>Acciones</th>
    </thead>
    <tbody>
      @foreach($situaciones as $situacion)
      <tr>
        <td>{{ date('d/m/Y H:i:s', strtotime($situacion->inicia_el)) }}</td>
        <td>{{ date('d/m/Y H:i:s', strtotime($situacion->finaliza_el)) }}</td>
        <td>{{ $situacion->descripcion }}</td>
        <td>
          <form method="POST" action="{{ route('cortes.situaciones.destroy', $situacion->id) }}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="_method" value="DELETE">

              <a href="#" class="btn btn-primary btn-sm" title="editar">
                <span class="fa fa-pencil"></span>
              </a>

              <button class="btn btn-danger btn-sm" type="submit" title="Eliminar">
                <span class="fa fa-times"></span>
              </button>

            </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>


@section('body-scripts')
@parent

<script type="text/javascript">
  (function($, swal){
    $('#situaciones-table').on('submit', 'form', function(event){

      event.preventDefault();

      swal({
        title: "¿Estás seguro?",
        text: "El registro se va a eliminar",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: 'No del todo',
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Seguro!",
        closeOnConfirm: false
      },
      function() {
        event.target.submit();
      });
    });
  })(window.jQuery, window.swal);
</script>

@endsection
